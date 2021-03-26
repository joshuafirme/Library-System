<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Auth;

class BookSearchCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
        
            if(request()->ajax())
            {
                return datatables()->of($this->getBooks())
                ->make(true);      
            }
    
            return view('transaction.book-search');
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
}
