<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class AuditTrailCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check())
        {
            if(request()->ajax())
            {
                return datatables()->of($this->getAuditTrail($request->date_from, $request->date_to))
                ->addColumn('user_type', function($b){
                    if($b->user_type == 0){
                        $z = '<span>Administrator</p>';         
                        return $z;
                    }
                    else{
                        $z = '<span>Librarian</p>';         
                        return $z;
                    }
                })
                ->rawColumns(['user_type'])
                ->make(true);      
            }
            return view('utilities.audit-trail');
        }

    }

    public function getAuditTrail($date_from, $date_to)
    {
        return DB::table('tbl_audit_trail AS A')
        ->select('A.*', 'U.user_id', 'U.name', 'U.user_type')
        ->leftJoin('tbl_users AS U', 'U.id', '=', 'A.user_id')
        ->whereBetween('A.created_at', [$date_from, date('Y-m-d', strtotime($date_to . " + 1 day"))])
        ->get();
    }
}
