<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class WeedBookCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if(request()->ajax())
            {
                return datatables()->of($this->getWeedBooks())
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-book" book-id="'. $b->book_id .'" 
                    data-toggle="modal" data-target="#retrieveBookModal"><i class="fa fa-recycle"></i></a>';
                    return $button;
                })
                ->rawColumns(['action'])
                    ->make(true);      
            }
    
            return view('maintenance.weed-book');
        }
        else{
            return redirect('/');
        }

    }

    public function getWeedBooks()
    {
       return DB::table('tbl_weed AS W')
                ->select('B.*', 'W.*', 'category','classification')
                ->leftJoin('tbl_books AS B', 'B.id', '=', 'W.book_id')
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->get();
    }

    public function retrieve()
    {
        $data = Input::all();

        if($this->getWeedCopies($data['id_retrieve']) < $data['copies'])
        {
            return redirect('/weed-maintenance')->with('danger', 'The copy entered was greater than book copies. Please enter a valid value!');
        }
        else{
            DB::table('tbl_books')
            ->where('id', $data['id_retrieve'])
            ->update([
                'copies' => DB::raw('copies + '.$data['copies']),
                'updated_at' => date('Y-m-d h:m:s'),
                'is_weed' => 0
            ]);

            DB::table('tbl_weed')
            ->where('book_id', $data['id_retrieve'])
            ->update([
                'copies' => DB::raw('copies - '.$data['copies']),
                'updated_at' => date('Y-m-d h:m:s')
            ]);
        }

        \app\Helpers\base::recordAction(Auth::id(), 'Weed Maintenance', 'retrieve');
        
        return redirect('/weed-maintenance')->with('success', 'Book was retrieve successfully');
    }

    public function getWeedCopies($id)
    {
        return DB::table('tbl_weed')
                ->where('book_id', $id)
                ->value('copies');
    }
}
