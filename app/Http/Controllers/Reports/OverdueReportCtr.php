<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use DB, Auth;
class OverdueReportCtr extends Controller
{
    public function index(Request $request)
    {
        $this->updatePenalty();

        if (Auth::check()) {
            $data = $this->getOverdueBooks($request->date_from, $request->date_to);
            if(request()->ajax())
            {
                return datatables()->of($data)
                ->make(true);      
            }
    
            return view('reports.overdue-report');
        }
        else{
            return redirect('/');
        }

    }

    public function getOverdueBooks($date_from, $date_to)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'BR.created_at')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.status', 2)
                ->whereBetween('BR.due_date', [$date_from, $date_to])
                ->get();
    }


    public function previewReport($date_from, $date_to)
    {
        $overdue = $this->getOverdueBooks($date_from, $date_to);

        $output = base::convertDataToHTML($overdue, $date_from, $date_to, 'Overdue');
    
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
    
        return $pdf->stream();
    }

    public function updatePenalty(){
        DB::table('tbl_book_borrowed')
        ->whereRaw('due_date < CURDATE()')
        ->update([
            'is_penalty' => 1,
            'status' => 2
        ]);  
    }
}
