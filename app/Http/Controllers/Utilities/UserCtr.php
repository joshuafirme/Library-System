<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Hash;

class UserCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getUsers())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#editBookModal"><i class="fa fa-edit"></i></a>';

                $button .= ' <a class="btn btn-sm btn-danger" id="btn-weed-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#weedModal"><i class="fa fa-archive"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('utilities.user-maintenance',);
    }

    public function getUsers()
    {
       return DB::table('tbl_users')
                ->where('user_type', 0)
                ->get();
    }

    public function displayStudent()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getStudent())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#editBookModal"><i class="fa fa-edit"></i></a>';

                $button .= ' <a class="btn btn-sm btn-danger" id="btn-weed-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#weedModal"><i class="fa fa-archive"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }
    }

    public function getStudent()
    {
       return DB::table('tbl_users as U')
                ->select('U.*', 'G.grade')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->where('user_type', 2)
                ->get();
    }

    public function store()
    {
        $data = Input::all();

        if($data['user_type'] == 0)
        {
            $this->insertUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
        }
        else if($data['user_type'] == 1)
        {
            $this->insertUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);

            DB::table('tbl_dept')
            ->insert([
                'user_id' => $data['user_id'],
                'department' => $data['department'],
            ]); 
        }
        else if($data['user_type'] == 2)
        {
            $this->insertUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
            
            DB::table('tbl_grade')
            ->insert([
                'user_id' => $data['user_id'],
                'grade' => $data['grade'],
            ]); 
        }
       

        return redirect('/user-maintenance')->with('success', 'Data Saved');
    }

    public function insertUser($user_id, $name, $password, $contact, $address, $user_type)
    {
        DB::table('tbl_users')
        ->insert([          
            'user_id' => $user_id,
            'name' => $name,
            'password' => Hash::make($password),
            'address' => $address,
            'contact_no' => $contact,
            'user_type' => $user_type,
            'archive_status' => 0
        ]); 
    }
}
