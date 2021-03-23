<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Input, Auth, Redirect;

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
            return Redirect::to('/book-search');
        }
        else{
            return Redirect::to('/')->with('danger', 'Invalid User ID or password'); 
        }
       
    }
    public function logout()
    {
       Auth::logout();
       return Redirect::to('/');
    }
}
