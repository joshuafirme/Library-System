<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;
class DashboardCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
        
            if(request()->ajax())
            {
                return datatables()->of($this->getBooks())
                ->make(true);      
            }
    
            return view('dashboard');
        }
        else{
            return redirect('/');
        }
    }

    public function displayBorrowed()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBorrowed())
            ->addColumn('status', function($b){
                switch($b->status){
                    case 0:
                        return '<span class="badge badge-primary">Unreturned</span>';
                        break;
                    case 1:
                        return '<span class="badge badge-success">Returned</span>';
                        break;
                    case 2:
                        return '<span class="badge badge-warning">Overdue</span>';
                        break;
                    case 3:
                        return '<span class="badge badge-danger">Loss</span>';
                        break;
                }
            })
            ->rawColumns(['status'])
            ->make(true);      
        }
    }

    public function displayReserved()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getReserved())
            ->addColumn('status', function($b){
              return $b->is_approve==0 ? '<span class="badge badge-primary">Pending</span>' : '<span class="badge badge-success">Approved</span>';
            })
            ->rawColumns(['status'])
            ->make(true);      
        }
    }

    public function getBorrowed()
    {
       return DB::table('tbl_book_borrowed AS BR')
       ->select('BR.*', 'B.*', 'C.category', 'C.classification')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_users AS U', 'U.id', '=', 'BR.user_id')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->whereNotIn('BR.status', [4])
                ->where('U.id', Auth::id())
                ->get();
    }

    public function getReserved()
    {
       return DB::table('tbl_book_reserve AS BR')
                ->select('BR.*', 'B.*', 'C.category', 'C.classification')
                ->leftJoin('tbl_books AS B', 'B.accession_no', '=', 'BR.accession_no')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('BR.user_id', Auth::id())
                ->get();
    }
}
