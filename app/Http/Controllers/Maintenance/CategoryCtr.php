<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input, DB, Auth;
class CategoryCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('maintenance.category',[
                'category' => $this->getCategories(),
            ]);
        }
        else{
            return redirect('/');
        }

    }

    public function store()
    {
        $data = Input::all();

        DB::table('tbl_category')
            ->insert([
                'category' => $data['category'],
                'classification' => $data['classification']
            ]);

        return redirect('/category-maintenance')->with('success', 'Data Saved');
    }

    public function update()
    {
        $data = Input::all();

        DB::table('tbl_category')
            ->where('id', $data['id_hidden'])
            ->update([
                'category' => $data['category'],
                'classification' => $data['classification']
            ]);

        return redirect('/category-maintenance')->with('success', 'Data updated successfully');
    }

    public function getCategories()
    {
       return DB::table('tbl_category')->get();
    }


    public function getCategoryDetails($id)
    {
       return DB::table('tbl_category')->where('id', $id)->get();
    }

    public function getClassification($category)
    {
       return DB::table('tbl_category')->where('category', $category)->get();
    }

    
}
