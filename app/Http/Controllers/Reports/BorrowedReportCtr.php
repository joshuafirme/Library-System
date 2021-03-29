<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Input, Auth;

class BorrowedReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = $this->getBorrowedBooks($request->date_from, $request->date_to);
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->make(true);      
            }
    
            return view('reports.borrowed-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getBorrowedBooks($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 0)
                ->whereBetween('BR.created_at', [$date_from, date('Y-m-d', strtotime($date_to. ' + 1 days'))])
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $borrowed = $this->getBorrowedBooks($date_from, $date_to);

        $output = base::convertDataToHTML($borrowed, $date_from, $date_to, 'Borrowed');
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }
}
