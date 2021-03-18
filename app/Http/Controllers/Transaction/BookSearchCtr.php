<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BookSearchCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->make(true);      
        }

        return view('transaction.book-search');
    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 0)
                ->get();
    }
}
