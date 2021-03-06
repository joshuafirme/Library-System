<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class PenaltyPaymentCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getPenaltyList())
                ->addColumn('action', function($b){
                    $button =  '<a class="btn btn-sm btn-success" id="btn-pay" user-id="'. $b->user_id .'" accession-no="'. $b->accession_no .'" status="'. $b->status .'"
                    data-toggle="modal" data-target="#payModal"><i class="fa fa-dollar-sign"></i></a>';
    
                    return $button;
                })
                ->addColumn('remarks', function($b){
                    if($b->status == 2){
                        $p = '<span class="badge badge-warning">Overdue</span>';
                    }else if($b->status == 3){
                        $p = '<span class="badge badge-danger">Loss</span>';
                    }
                    return $p;
                })
                ->rawColumns(['action', 'remarks'])
                ->make(true);      
            }
    
            return view('transaction.penalty-payment');
        }
        else{
            return redirect('/');
        }

    }

    public function displayPaid()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getPenaltyPaid())
            ->addColumn('remarks', function($b){
                if($b->status == 4){
                    $p = '<span class="badge badge-success">Paid</span>';
                }
                return $p;
            })
            ->rawColumns(['remarks'])
            ->make(true);      
        }

    }

    public function getPenaltyList()
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->whereIn('status', [2, 3])
                ->get();
    }

    public function getPenaltyPaid()
    {
       return DB::table('tbl_book_borrowed AS BR')
                ->select('BR.*', 'U.user_id', 'U.name', 'U.contact_no', 'B.title')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('status', 4)
                ->get();
    }

    public function pay()
    {
        $data = Input::all();

        DB::table('tbl_book_borrowed as BR')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('U.user_id', $data['user_id'])
                ->where('BR.accession_no', $data['accession_no'])
                ->update([
                    'status' => 4
                ]);

        return redirect('/penalty-payment')->with('success', 'The penalty amount was successfully paid.');        
    }

    public static function getBookAmoutIfLoss($accession_no)
    {
       return DB::table('tbl_books as B')->where('B.accession_no', $accession_no)->value('amount_if_lost');
    }
}
