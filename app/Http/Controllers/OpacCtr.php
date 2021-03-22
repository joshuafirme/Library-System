<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OpacCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->make(true);      
        }

        return view('opac');
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
