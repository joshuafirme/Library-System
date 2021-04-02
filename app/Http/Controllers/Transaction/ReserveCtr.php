<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth, Helper;
use App\Helpers\base;

class ReserveCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
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
        else{
            return redirect('/');
        }

    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', 'category','classification')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 0)
                ->get();
    }

    public function reserveBook()
    {
        $data = Input::all();

        if(base::hasOneLeftBook($data['accession_no']))
        {
            return redirect('/reserve-book')->with('danger', 'Reservation denied! The book have only 1 copy remaining.');
        }
        else{
            if(base::isBookAlreadyReserved(Auth::id(), $data['accession_no']))
            {
                return redirect('/reserve-book')->with('danger', 'You have already reserved this book with accession number '.$data['accession_no']);
            }
            else
            {
                if(base::isLimitReached())
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
            
        }
        
        
        return redirect('/reserve-book')->with('success', 'You have successfully reserved a book');
    }

  

/*
|--------------------------------------------------------------------------
| Approve Reservation
|--------------------------------------------------------------------------
*/
    public function approve_reservation_view()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getReservationList())
            ->addColumn('action', function($r){
                $button =  '<a class="btn btn-sm btn-success mr-2" id="btn-approve" user-id="'. $r->borrower_id .'" accession-no="'. $r->accession_no .'"
                data-toggle="modal" data-target="#approveModal"><i class="fa fa-check-circle"></i></a>';

                $button .=  '<a class="btn btn-sm btn-danger" id="btn-decline" user-id="'. $r->borrower_id .'" accession-no="'. $r->accession_no .'"
                data-toggle="modal" data-target="#declineModal"><i class="fa fa-minus-circle"></i></a>';


                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('transaction.approve-reservation');
    }

    public function getReservationList()
    {
       return DB::table('tbl_book_reserve AS BR')
                ->select('BR.*', 'U.user_id', 'BR.user_id as borrower_id', 'U.name', 'B.title')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->where('BR.is_approve', 0)
                ->get();
    }

    
    public function approveReservation()
    {
        $data = Input::all();

        if(base::hasOneLeftBook($data['accession_no']))
        {
            return redirect('/reserve-book')->with('danger', 'Approval denied! The book have only 1 copy remaining.');
        }
        else{
            $row = DB::table('tbl_book_reserve')
            ->where('user_id', $data['user_id'])
            ->where('accession_no', $data['accession_no'])
            ->update([
                'is_approve' => 1
            ]);

            return redirect('/approve-reservation')->with('success', 'Reservation was approved successfully');
        }
       
    }

    public function declineReservation()
    {
        $data = Input::all();

        $row = DB::table('tbl_book_reserve')
                ->where('user_id', $data['user_id'])
                ->where('accession_no', $data['accession_no'])
                ->update([
                    'is_approve' => -1
                ]);
                
        return redirect('/approve-reservation')->with('success', 'Reservation was declined successfully');
    }
}
