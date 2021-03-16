<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input;

class WeedBookCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getWeedBooks())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#retrieveBookModal"><i class="fa fa-recycle"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
                ->make(true);      
        }

        return view('maintenance.weed-book');
    }

    public function getWeedBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification, copies'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->leftJoin('tbl_book_copies AS BC', 'BC.book_id', '=', 'B.id')
                ->where('is_weed', 1)
                ->get();
    }
}