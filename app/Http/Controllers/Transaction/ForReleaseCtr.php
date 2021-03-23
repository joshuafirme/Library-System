<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class ForReleaseCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getForRelease())
                ->addColumn('action', function($r){
                    $button =  '<a class="btn btn-sm btn-success mr-2" id="btn-release" user-id="'. $r->borrower_id .'" accession-no="'. $r->accession_no .'"
                    data-toggle="modal" data-target="#releaseModal"><i class="fa fa-check-circle"></i></a>';
    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);      
            }
    
            return view('transaction.for-release');
        }
        else{
            return redirect('/');
        }

    }

    public function getForRelease()
    {
       return DB::table('tbl_book_reserve AS BR')
                ->select('BR.*', 'U.user_id', 'BR.user_id as borrower_id', 'U.name', 'B.title')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.is_approve', 1)
                ->get();
    }

    
    public function release()
    {
        $data = Input::all();

        DB::table('tbl_book_reserve')
            ->where('user_id', $data['user_id'])
            ->where('accession_no', $data['accession_no'])
            ->delete();

        DB::table('tbl_book_borrowed')
            ->insert([
                'user_id' => $data['user_id'],
                'accession_no' => $data['accession_no'],
                'status' => 0,
                'is_penalty' => 0,
                'created_at' => date('Y-m-d h:m:s'),
                'due_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + 6 days')),
            ]);

            DB::table('tbl_books as B')
            ->where(DB::raw('CONCAT(B._prefix, B.accession_no)'), $data['accession_no'])
            ->update([
                'copies' => DB::raw('copies - 1')
            ]);     

        return redirect('/for-release')->with('success', 'The book was release.');
    }
}
