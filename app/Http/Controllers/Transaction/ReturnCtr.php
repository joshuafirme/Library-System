<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class ReturnCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getReturnedBooks())
                ->addColumn('action', function($b){
                    $button =  '<a class="btn btn-sm btn-success" id="btn-return-book" user-id="'. $b->user_id .'" accession-no="'. $b->accession_no .'"  
                    data-toggle="modal" data-target="#returnModal"><i class="fa fa-hand-holding"></i></a>';
    
                    return $button;
                })
                ->addColumn('status', function($b){
                    if($b->status == 0){
                        $p = '<span class="badge badge-warning">Unreturned</span>';
                    }
                    return $p;
                })
                ->addColumn('is_penalty', function($b){
                    if($b->is_penalty == 1){
                        $z = '<span class="badge badge-danger">Yes</span>';         
                        return $z;
                    }
                    else{
                        $z = '<span class="badge badge-success">No</span>';         
                        return $z;
                    }
                })
                ->rawColumns(['action', 'status', 'is_penalty'])
                ->make(true);      
            }
    
            return view('transaction.return-book');
        }
        else{
            return redirect('/');
        }

    }

    public function getReturnedBooks()
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('status', 0)
                ->get();
    }

    public function getBorrowedDetails($user_id, $accession_no)
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title', 'grade', 'department')
                ->leftJoin('tbl_books AS B', DB::raw('CONCAT(B._prefix, B.accession_no)'), '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->leftJoin('tbl_dept AS D', 'D.user_id', '=', 'U.user_id')
                ->where('U.user_id', $user_id)
                ->where('BR.accession_no', $accession_no)
                ->get();
    }

    public function return()
    {
        $data = Input::all();
        DB::table('tbl_book_borrowed AS BR')
            ->where('U.user_id', $data['user_id'])
            ->where('BR.accession_no', $data['accession_no'])
            ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
            ->update([
                'status' => $data['remarks'],
                'updated_at' => date('Y-m-d h:m:s')
            ]);

        return redirect('/return-book')->with('success', 'The book was successfully returned');
    }
}
