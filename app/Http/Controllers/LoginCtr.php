<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Input, Auth;

class LoginCtr extends Controller
{

    public function index(){
        return view('login');
    }

    public function login()
    {
        $data = Input::all();

        if (Auth::attempt(['user_id' => $data['user_id'], 'password' => $data['password']])) 
        {
            return redirect('/book-search')->send();
        }
        else{
            return redirect('/')->with('invalid', 'Invalid User ID or password'); 
        }
       
    }
    
    public function isAccountExists($phone_email)
    {
        $acc =  DB::table($this->tbl_cust_acc)
        ->where('phone_no', $phone_email)
        ->orWhere('email', $phone_email)
        ->get(); 
        
        if($acc->count() > 0){
            return true;
        }

    }
}
