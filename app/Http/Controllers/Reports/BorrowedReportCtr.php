<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input;

class BorrowedReportCtr extends Controller
{
    public function index(Request $request)
    {
      //  dd($this->getBorrowedBooks('2021-03-22', '2021-03-24'));
        $data = $this->getBorrowedBooks($request->date_from, $request->date_to);
        if(request()->ajax())
        {
            return datatables()->of($data)
            ->make(true);      
        }

        return view('reports.borrowed-report');
    }

    public function getBorrowedBooks($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 0)
                ->whereBetween('BR.created_at', [$date_from, $date_to])
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $borrowed = $this->getBorrowedBooks($date_from, $date_to);

        $output = $this->convertDataToHTML($borrowed, $date_from, $date_to);
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }
    
    public function convertDataToHTML($borrowed, $date_from, $date_to)
    {
        $output = '
        <div style="width:100%">
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
        <h1 style="text-align:center;">Borrowed Report</h1>

        <table width="100%" style="border-collapse:collapse; border: 1px solid;">
                      
            <thead>
                <tr>
                    <th style="border: 1px solid;">User ID</th>    
                    <th style="border: 1px solid;">Borrower</th>    
                    <th style="border: 1px solid;">Contact Number</th>     
                    <th style="border: 1px solid;">Accession No</th>
                    <th style="border: 1px solid;">Title</th>
                    <th style="border: 1px solid;">Due Date</th> 
                    <th style="border: 1px solid;">Is overdue</th> 
            </thead>
            <tbody>
                ';

    
            if($borrowed){
                foreach ($borrowed as $data) {
                       
                if($data->is_penalty==1){
                    $penalty = "Yes";
                }else{
                    $penalty = "No";
                }
                    $output .='
                    <tr>  
                    <td style="border: 1px solid; padding:10px;">'. $data->user_id .'</td>      
                    <td style="border: 1px solid; padding:10px;">'. $data->name .'</td>                     
                    <td style="border: 1px solid; padding:10px;">'. $data->contact_no .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->accession_no.'</td>  
                    <td style="border: 1px solid; padding:10px;">'. $data->title .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->due_date .'</td>   
                    <td style="border: 1px solid; padding:10px;">'. $penalty .'</td>             
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
