<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Input, Auth;

class ReturnedReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = $this->getReturnedBooks($request->date_from, $request->date_to);
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->make(true);      
            }
    
            return view('reports.returned-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getReturnedBooks($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 1)
                ->whereBetween('BR.created_at', [$date_from, $date_to])
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $returned = $this->getReturnedBooks($date_from, $date_to);

        $output = base::convertDataToHTML($returned, $date_from, $date_to, 'Returned');
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }
}
