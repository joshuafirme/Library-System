<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Auth;

class PenaltyCtr extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('maintenance.penalty',[
                'days' => $this->getDays(),
                'penalty' => $this->getPenalty()
            ]);
        }
        else{
            return redirect('/');
        }

    }

    public function activate()
    {
        $data = Input::all();
        $row = DB::table('tbl_penalty')->get();

        if($row->count() > 0)
        {
            DB::table('tbl_penalty')
            ->update([
                'days' => $data['days'],
                'penalty' => $data['penalty']
            ]);    
        }
        else
        {        
            DB::table('tbl_penalty')
                ->insert([
                    'days' => $data['days'],
                    'penalty' => $data['penalty']
                ]);
        }

        return redirect('/penalty-maintenance')->with('success', 'Penalty activated successfully');
    }

    public function getDays()
    {
        return DB::table('tbl_penalty')->value('days');
    }

    public function getPenalty()
    {
        return DB::table('tbl_penalty')->value('penalty');
    }
}
