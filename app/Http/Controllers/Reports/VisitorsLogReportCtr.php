<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Auth;

class VisitorsLogReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getVisitorsLog($request->date_from, $request->date_to))
                ->addColumn('in_out', function($b){
                    if($b->in_out == 0){
                        $z = '<span class="badge badge-warning">Out</span>';         
                        return $z;
                    }
                    else{
                        $z = '<span class="badge badge-success">In</span>';         
                        return $z;
                    }
                })
                ->rawColumns(['in_out'])
                ->make(true);      
            }
            return view('reports.visitors-log-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getVisitorsLog($date_from, $date_to)
    {
       return DB::table('tbl_visitors_log AS V')
                ->select('V.*', 'U.user_id', 'U.name', 'G.grade', 'V.created_at')
                ->leftJoin('tbl_users AS U', 'U.user_id', '=', 'V.user_id')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->whereBetween('V.created_at', [$date_from, date('Y-m-d', strtotime($date_to . " + 1 day"))])
                ->orderBy('V.id', 'desc')
                ->get();
    }

    public function previewReport($date_from, $date_to)
    {
        $log = $this->getVisitorsLog($date_from, $date_to);

        $output = $this->convertDataToHTML($log, date('Y-m-d'), date('Y-m-d'), "Visitor's Log");
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }

    public static function convertDataToHTML($report_data, $date_from, $date_to, $report_title)
    {
        $output = '
        <style>
        .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        }
        </style>
        <img class="center" src="img/logo.png" style="width:100px;">
        <div style="width:100%">
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
        <h1 style="text-align:center;">'.$report_title.' Report</h1>

        <table width="100%" style="border-collapse:collapse; border: 1px solid;">
                      
            <thead>
                <tr>
                    <th style="border: 1px solid;">User ID</th>   
                    <th style="border: 1px solid;">Name</th>   
                    <th style="border: 1px solid;">Grade</th> 
                    <th style="border: 1px solid;">Date time</th>    
                    <th style="border: 1px solid;">Remarks</th>   
            </thead>
            <tbody>
                ';

    
            if($report_data){
                foreach ($report_data as $data) {
                    if($data->in_out == 0){
                        $remarks = '<span class="badge badge-warning">Out</span>';       
                    }
                    else{
                        $remarks = '<span class="badge badge-success">In</span>';  
                    }
                    $output .='
                    <tr>  
                    <td style="border: 1px solid; padding:10px;">'. $data->user_id .'</td>      
                    <td style="border: 1px solid; padding:10px;">'. $data->name .'</td>                     
                    <td style="border: 1px solid; padding:10px;">'. $data->grade .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->created_at .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $remarks .'</td>        
                </tr>
                ';
                
                } 
            }
            else{
                echo "No data found";
            }
        
          
            $output .='
            </tbody>
        </table>
    
            </div>';
    
        return $output;
    }
}
