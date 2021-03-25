<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class ArchiveCtr extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check())
        {
            if(request()->ajax())
            {
                return datatables()->of($this->getArchiveUsers($request->date_from, $request->date_to))
                ->addColumn('action', function($b){
                    $button = ' <a class="btn btn-sm btn-primary" id="btn-retrieve-user" user-id="'. $b->id .'"
                    data-toggle="modal" data-target="#retrieveUserModal"><i class="fa fa-recycle"></i></a>';
    
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);      
            }
            return view('utilities.archive');
        }

    }

    public function getArchiveUsers($date_from, $date_to)
    {
        return DB::table('tbl_users as U')
        ->select('U.*', 'G.grade')
        ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id', 'U.updated_at')
        ->whereIn('user_type', [1,2])
        ->where('archive_status', 1)
        ->get();
    }

    public function retrieve()
    {
        $data = Input::all();
        DB::table('tbl_users')
            ->where('id', $data['id_retrieve'])
            ->update([
                'archive_status' => 0
            ]);

        
        return redirect('/archive')->with('success', 'User was retrieve successfully');
    }
}
