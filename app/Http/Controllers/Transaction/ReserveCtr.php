<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class ReserveCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->addColumn('action', function($b){
                $button =  '<a class="btn btn-sm btn-success" id="btn-reserve-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#reserveBookModal"><i class="fa fa-bookmark"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('transaction.reserve-book');
    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 0)
                ->get();
    }

    public function reserveBook()
    {
        $data = Input::all();

        if($this->isBookAlreadyReserved(Auth::id(), $data['accession_no']))
        {
            return redirect('/reserve-book')->with('danger', 'You have already reserved this book with accession number '.$data['accession_no']);
        }
        else
        {
            if($this->isLimitReached())
            {
                return redirect('/reserve-book')->with('danger', 'Reservation denied!. Because you have already reached the borrowing limit!');
            }
            else{
                DB::table('tbl_book_reserve')
                ->insert([
                    'user_id' => Auth::id(),
                    'accession_no' => $data['accession_no'],
                    'reservation_date' => $data['reservation_date'],
                    'is_approve' => 0,
                ]);
            }
        }
        
        
        return redirect('/reserve-book')->with('success', 'You have successfully reserved a book');
    }

    public function isBookAlreadyReserved($user_id, $accession_no)
    {
        $row = DB::table('tbl_book_reserve')
                ->where('user_id', $user_id)
                ->where('accession_no', $accession_no)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function isLimitReached()
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', Auth::id())
                ->where('is_returned', 0)
                ->get();
                
        if($row->count() == 3){
            return true;
        }else{
            return false;
        }
    }
}
