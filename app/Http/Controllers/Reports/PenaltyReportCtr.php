<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Auth;

class PenaltyReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = $this->getPenaltyList($request->date_from, $request->date_to);
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->addColumn('status', function($d){
                    if($d->status == 2){
                        $z = '<span class="badge badge-warning">Overdue</span>';         
                        return $z;
                    }
                    else{
                        $z = '<span class="badge badge-danger">Loss</span>';         
                        return $z;
                    }
                })
                ->rawColumns(['status'])
                ->make(true);      
            }
    
            return view('reports.penalty-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getPenaltyList($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->whereIn('BR.status', [2, 3])
                ->whereBetween('BR.updated_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))]) // date that the borrower report to librarian, return, loss, overdue
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $overdue = $this->getPenaltyList($date_from, $date_to);

        $output = $this->convertDataToHTML($overdue, $date_from, $date_to, 'Overdue');
    
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
                    <th style="border: 1px solid;">Borrower</th>    
                    <th style="border: 1px solid;">Contact Number</th>     
                    <th style="border: 1px solid;">Accession No</th>
                    <th style="border: 1px solid;">Title</th>
                    <th style="border: 1px solid;">Date time borrowed</th>
                    <th style="border: 1px solid;">Due Date</th> 
                    <th style="border: 1px solid;">Status</th> 
            </thead>
            <tbody>
                ';

    
            if($report_data){
                foreach ($report_data as $data) {
                       
                if($data->status==2){
                    $status = "Overdue";
                }else{
                    $status= "Loss";
                }
                    $output .='
                    <tr>  
                    <td style="border: 1px solid; padding:10px;">'. $data->user_id .'</td>      
                    <td style="border: 1px solid; padding:10px;">'. $data->name .'</td>                     
                    <td style="border: 1px solid; padding:10px;">'. $data->contact_no .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->accession_no.'</td>  
                    <td style="border: 1px solid; padding:10px;">'. $data->title .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->created_at .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->due_date .'</td>  
                    <td style="border: 1px solid; padding:10px;">'. $status .'</td>                        
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
