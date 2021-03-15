<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use DB;

class BookCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-product-maintenance" product-code="'. $b->id .'" 
                data-toggle="modal" data-target="#editProductModal"><i class="fa fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a class="btn btn-sm" id="delete-product" product-id="'. $b->id .'" delete-id="'. $b->id .'"><i style="color:#DC3545;" class="fas fa-archive"></i></a>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('maintenance.book',[
            'category' => $this->getCategories()
        ]);
    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->get();
    }

    public function store()
    {
        $data = Input::all();

        $id = DB::table('tbl_books')
                ->insertGetId([
                    '_prefix' => 'ACN'.date('Y'),
                    'accession_no' => $this->getAccessionNo(),
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'publisher' => $data['publisher'],
                    'category_id' => $data['category'],
                    'sub_category' => $data['classification'],
                    'edition' => $data['edition'],
                    'no_of_pages' => $data['no_of_pages'],
                    'amount_if_lost' => $data['amount_if_lost'],
                    'cost' => $data['cost'],
                    'date_acq' => $data['date_acq'],
                    'date_published' => $data['date_published'],
                    'is_weed' => 0
                ]);
        $this->storeBookCopies($id, $data['copies']);

        return redirect('/book-maintenance')->with('success', 'Data Saved');
    }

    public function storeBookCopies($id, $copies)
    {
        DB::table('tbl_book_copies')
        ->insert([
            'book_id' => $id,
            'copies' => $copies
        ]);
    }

    public function update()
    {
        $data = Input::all();

        DB::table('tbl_books')
            ->update([
                'title' => $data['title'],
                'author' => $data['author'],
                'publisher' => $data['publisher'],
                'category' => $data['category'],
                'sub_category' => $data['sub_category'],
                'edition' => $data['edition'],
                'no_of_pages' => $data['no_of_pages'],
                'amount_if_lost' => $data['amount_if_lost'],
                'cost' => $data['cost'],
                'date_acq' => $data['date_acq'],
                'date_published' => $data['date_published'],
                'is_weed' => 0
            ]);

        return redirect('/book-maintenance')->with('success', 'Data updated successfully');
    }

    public function weed()
    {
        DB::table('tbl_books')
            ->update([
                'is_weed' => 1
            ]);

        return redirect('/book-maintenance')->with('success', 'Book weed successfully');
    }

    public function getAccessionNo()
    {
        $sales_inv_no = DB::table('tbl_books')
        ->max('accession_no');
        $inc = ++ $sales_inv_no;
        return str_pad($inc, 5, '0', STR_PAD_LEFT);
    }

    public function getCategories()
    {
       $categories = DB::table('tbl_category')->get();
       return $categories->unique('category');
    }
}
