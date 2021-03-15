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
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#editBookModal"><i class="fa fa-edit"></i></a>';
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
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification, copies'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->leftJoin('tbl_book_copies AS BC', 'BC.book_id', '=', 'B.id')
                ->get();
    }

    public function store()
    {
        $data = Input::all();

        $category_id = $this->getCategoryID($data['category'],$data['classification']);

        $id = DB::table('tbl_books')
                ->insertGetId([
                    '_prefix' => 'ACN'.date('Y'),
                    'accession_no' => $this->getAccessionNo(),
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'publisher' => $data['publisher'],
                    'category_id' => $category_id,
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

    public function getCategoryID($category, $classification)
    {
      return DB::table('tbl_category')
                ->where('category', $category)
                ->where('classification', $classification)
                ->value('id');
    }

    public function getBookDetails($id)
    {
        return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no, category, classification, copies'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->leftJoin('tbl_book_copies AS BC', 'BC.book_id', '=', 'B.id')
                ->where('B.id', $id)
                ->get();
    }

    public function update()
    {
        $data = Input::all();

        $category_id = $this->getCategoryID($data['category'],$data['classification']);

        DB::table('tbl_books')
            ->where('id', $data['id_hidden'])
            ->update([
                'title' => $data['title'],
                'author' => $data['author'],
                'publisher' => $data['publisher'],
                'category_id' => $category_id,
                'edition' => $data['edition'],
                'no_of_pages' => $data['no_of_pages'],
                'amount_if_lost' => $data['amount_if_lost'],
                'cost' => $data['cost'],
                'date_acq' => $data['date_acq'],
                'date_published' => $data['date_published'],
                'is_weed' => 0
            ]);

        $this->updateBookCopies($data['id_hidden'], $data['copies']);

        return redirect('/book-maintenance')->with('success', 'Data updated successfully');
    }

    public function updateBookCopies($id, $copies)
    {
        DB::table('tbl_book_copies')
        ->where('book_id', $id)
        ->update([
            'copies' => $copies
        ]);
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

    public function getAccessionNo_ajax()
    {
        $sales_inv_no = DB::table('tbl_books')
        ->max('accession_no');
        $inc = ++ $sales_inv_no;
        return 'ACN' . date('Y') . str_pad($inc, 5, '0', STR_PAD_LEFT);
    }

    public function getCategories()
    {
       $categories = DB::table('tbl_category')->get();
       return $categories->unique('category');
    }
}
