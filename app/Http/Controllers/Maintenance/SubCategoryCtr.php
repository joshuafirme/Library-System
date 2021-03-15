<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use DB;

class SubCategoryCtr extends Controller
{
    public function index()
    {
        return view('maintenance.sub-category',[
            'subcategory' => $this->getSubCategories()
        ]);
    }

    public function store()
    {
        $data = Input::all();

        DB::table('tbl_sub_category')
            ->insert([
                'sub_category' => $data['sub_category']
            ]);

        return redirect('/sub-category-maintenance')->with('success', 'Data Saved');
    }

    public function getSubCategories()
    {
       return DB::table('tbl_sub_category')->get();
    }
}
