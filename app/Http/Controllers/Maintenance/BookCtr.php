<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\base;
use Input, DB, Session, Auth;

class BookCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getBooks())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary m-1" id="btn-view-book" book-id="'. $b->id .'" 
                    data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye"></i></a>';

                    $button .= ' <a class="btn btn-sm btn-success m-1" id="btn-edit-book" book-id="'. $b->id .'" 
                    data-toggle="modal" data-target="#editBookModal"><i class="fa fa-edit"></i></a>';
    
                    $button .= ' <a class="btn btn-sm btn-danger m-1" id="btn-weed-book" book-id="'. $b->id .'" 
                    data-toggle="modal" data-target="#weedModal"><i class="fa fa-archive"></i></a>';
    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);      
            }
    
            return view('maintenance.book',[
                'category' => $this->getCategories()
            ]);
        }
        else{
            return redirect('/');
        }

    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', 'category', 'classification')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->orderBy('id', 'asc')
                ->where('is_weed', 0)
                ->get();
    }

    

    public function store()
    {
        $data = Input::all();

        $category_id = base::getCategoryID($data['category'],$data['classification']);

        DB::table('tbl_books')
        ->insert([
            '_prefix' => 'ACN'.date('Y'),
            'accession_no' => $data['accession_no'],
            'title' => $data['title'],
            'author' => $data['author'],
            'copies' => $data['copies'],
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
        
        base::recordAction(Auth::id(), 'Book Maintenance', 'add');

        return redirect('/book-maintenance')->with('success', 'Data Saved');
    }



    public function getBookDetails($id)
    {
        return DB::table('tbl_books AS B')
                ->select('B.*', 'category', 'classification')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('B.id', $id)
                ->get();
    }

    public function update()
    {
        $data = Input::all();

        $category_id = base::getCategoryID($data['category'],$data['classification']);

        DB::table('tbl_books')
            ->where('id', $data['id_hidden'])
            ->update([
                '_prefix' => 'ACN'.date('Y'),
                'accession_no' => $data['accession_no'],
                'title' => $data['title'],
                'author' => $data['author'],
                'publisher' => $data['publisher'],
                'copies' => $data['copies'],
                'category_id' => $category_id,
                'edition' => $data['edition'],
                'no_of_pages' => $data['no_of_pages'],
                'amount_if_lost' => $data['amount_if_lost'],
                'cost' => $data['cost'],
                'date_acq' => $data['date_acq'],
                'date_published' => $data['date_published'],
                'is_weed' => 0
            ]);

        base::recordAction(Auth::id(), 'Book Maintenance', 'update');

        return redirect('/book-maintenance')->with('success', 'Data updated successfully');
    }


    public function weed()
    {
        $data = Input::all();
        DB::table('tbl_books')
            ->where('id', $data['id_weed'])
            ->update([
                'is_weed' => 1,
                'updated_at' => date('Y-m-d h:m:s')
            ]);

            base::recordAction(Auth::id(), 'Book Maintenance', 'weed');

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


    function import(Request $request)
    {
        $file = $request->file('file');

        base::CSVImporter($file, 'book');
        base::recordAction(Auth::id(), 'Maintenance', 'import');

        return redirect('/book-maintenance')->with('success', 'Data imported successfully!');          
    }
}
