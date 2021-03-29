<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Auth;

class UnreturnedReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = $this->getUnreturnedBooks();
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->make(true);      
            }
    
            return view('reports.unreturned-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getUnreturnedBooks()
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 0)
                ->get();
    }


    public function previewReport()
    {
        $unreturned = $this->getUnreturnedBooks();

        $output = base::convertDataToHTML($unreturned, date('Y-m-d'), date('Y-m-d'), 'Unreturned');
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }

    
}
