<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB, Auth;

class VisitorsLogCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
        
            if(request()->ajax())
            {
                return datatables()->of($this->getVisitorsLogAdmin($request->date_from, $request->date_to))
                ->addColumn('in_out', function($b){
                    if($b->in_out == 0){
                        $z = '<span class="badge badge-warning">Out</span>';         
                        return $z;
                    }
                    else{
                        $z = '<span class="badge badge-success">In</span>';         
                        return $z;
                    }
                })
                ->rawColumns(['in_out'])
                ->make(true);      
            }
    
            return view('visitors-log-admin');
        }
        else{
            return redirect('/');
        }
    }

    public function visitors_in_out_view()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getVisitorsLog())
            ->addColumn('in_out', function($b){
                if($b->in_out == 0){
                    $z = '<span class="badge badge-warning">Out</span>';         
                    return $z;
                }
                else{
                    $z = '<span class="badge badge-success">In</span>';         
                    return $z;
                }
            })
            ->rawColumns(['in_out'])
            ->make(true);      
        }
        return view('visitors-log');
    }
    
    public function visitorIn($user_id)
    {
        if($this->isUserIDValid($user_id))
        {
                DB::table('tbl_visitors_log')
                    ->insert([
                        'user_id' => $user_id,
                        'in_out' => 1,
                        'created_at' => date('Y-m-d h:m:s')
                    ]);
        }else{
            return '0';
        }      
    }

    public function visitorOut($user_id)
    {
        if($this->isUserIDValid($user_id))
        {
            DB::table('tbl_visitors_log')
                    ->insert([
                        'user_id' => $user_id,
                        'in_out' => 0,
                        'created_at' => date('Y-m-d h:m:s')
                    ]);
        }else{
            return '0';
        }
    }

    public function isUserIDValid($user_id)
    {
        $row=DB::table('tbl_users')
                    ->where('user_id', $user_id)->get();
            
        return $row->count() > 0 ? true : false;
    }

    public function getVisitorsLog()
    {
       return DB::table('tbl_visitors_log AS V')
                ->select('V.*', 'U.user_id', 'U.name', 'G.grade', 'V.created_at')
                ->leftJoin('tbl_users AS U', 'U.user_id', '=', 'V.user_id')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->whereDate('V.created_at', date('Y-m-d'))
                ->get();
    }

    public function getVisitorsLogAdmin($date_from, $date_to)
    {
       return DB::table('tbl_visitors_log AS V')
                ->select('V.*', 'U.user_id', 'U.name', 'G.grade', 'V.created_at')
                ->leftJoin('tbl_users AS U', 'U.user_id', '=', 'V.user_id')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->whereBetween('V.created_at', [$date_from, date('Y-m-d', strtotime($date_to . " + 1 day"))])
                ->get();
    }
}
