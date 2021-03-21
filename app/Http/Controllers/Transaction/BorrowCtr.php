<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input;
use App\Helpers\base;

class BorrowCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->addColumn('action', function($b){
                $button =  '<a class="btn btn-sm btn-success" id="btn-borrow-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#borrowModal"><i class="fa fa-bookmark"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('transaction.borrow-book');
    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 0)
                ->get();
    } 
    
    public function searchUser($search_key)
    {
       return DB::table('tbl_users AS U')
                ->select('U.*', 'U.id as user_id', 'grade', 'department')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->leftJoin('tbl_dept AS D', 'D.user_id', '=', 'U.user_id')
                ->where('U.user_id', 'LIKE', '%'.$search_key.'%')
                ->get();
    }

    public function borrow()
    {
        $data = Input::all();
        $days = base::getPenaltyDays();
        $b_name = base::getBorrowerName($data['user_id']);

        if(base::hasOneLeftBook($data['accession_no']))
        {
            return redirect('/borrow-book')->with('danger', 'Borrow denied! The book only have 1 copy remaining.');
        }
        else
        {
            if(!($this->isLimitReached($data['user_id'])))
            {
                if(base::isAlreadyBorrowed($data['user_id']))
                {
                    return redirect('/borrow-book')->with('danger', 'The book was already borrowed by '.$b_name);
                }else{
                    DB::table('tbl_book_borrowed')
                    ->insert([
                        'user_id' => $data['user_id'],
                        'accession_no' => $data['accession_no'],
                        'is_returned' => 0,
                        'status' => 0,
                        'created_at' => date('Y-m-d h:m:s'),
                        'due_date' => date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$days.' days')),
                    ]);
          
                    DB::table('tbl_books as B')
                    ->where(DB::raw('CONCAT(B._prefix, B.accession_no)'), $data['accession_no'])
                    ->update([
                        'copies' => DB::raw('copies - 1')
                    ]);   
        
                return redirect('/borrow-book')->with('success', 'The book was successfully borrowed.');
                }
            }  
            else{
                return redirect('/borrow-book')->with('danger', 'Borrow denied! '.$b_name.' has 3 unreturned books.');
            }    
        }
       
    }

    public static function isLimitReached($user_id)
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', $user_id)
                ->where('is_returned', 0)
                ->get();
                
        if($row->count() >= 3){
            return true;
        }else{
            return false;
        }
    }
}
