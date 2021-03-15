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
        return view('maintenance.book',[
            'category' => $this->getCategories()
        ]);
    }

    public function store()
    {
        $data = Input::all();

        $id = DB::table('tbl_books')
                ->insertGetId([
                    '_prefix' => 'ACN',
                    'accession_no' => $this->getAccessionNo(),
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
