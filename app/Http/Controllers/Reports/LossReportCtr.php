<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Auth;

class LossReportCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $data = $this->getLossBooks($request->date_from, $request->date_to);
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->make(true);      
            }
    
            return view('reports.loss-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getLossBooks($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 3)
                ->whereBetween('BR.created_at', [$date_from, $date_to])
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $loss_book = $this->getLossBooks($date_from, $date_to);

        $output = base::convertDataToHTML($loss_book, $date_from, $date_to, 'Loss Book');
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }
}
