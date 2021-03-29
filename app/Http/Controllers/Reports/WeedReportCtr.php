<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Auth;

class WeedReportCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getWeedBooks())
                    ->make(true);      
            }
    
            return view('reports.weed-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getWeedBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', 'category','classification')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 1)
                ->get();
    }

    public function previewReport()
    {
        $weed = $this->getWeedBooks();

        $output = $this->convertDataToHTML($weed, date('Y-m-d'), date('Y-m-d'), 'Weed Books');
    
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
                    <th style="border: 1px solid;">Accession Number</th>   
                    <th style="border: 1px solid;">Title</th> 
                    <th style="border: 1px solid;">Author</th>    
                    <th style="border: 1px solid;">Publisher</th>     
                    <th style="border: 1px solid;">Category</th>
                    <th style="border: 1px solid;">Classification</th>
                    <th style="border: 1px solid;">Edition</th> 
                    <th style="border: 1px solid;">Copies</th> 
                    <th style="border: 1px solid;">Date weed</th> 
            </thead>
            <tbody>
                ';

    
            if($report_data){
                foreach ($report_data as $data) {
                    $output .='
                    <tr>  
                    <td style="border: 1px solid; padding:10px;">'. $data->accession_no .'</td>      
                    <td style="border: 1px solid; padding:10px;">'. $data->title .'</td>                     
                    <td style="border: 1px solid; padding:10px;">'. $data->author .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->publisher .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->category .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->classification .'</td>   
                    <td style="border: 1px solid; padding:10px;">'. $data->edition .'</td> 
                    <td style="border: 1px solid; padding:10px;">'. $data->copies .'</td> 
                    <td style="border: 1px solid; padding:10px;">'. $data->updated_at .'</td>          
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
