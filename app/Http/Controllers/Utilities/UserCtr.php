<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Input, Hash, Auth;
use App\Helpers\base;

class UserCtr extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            return view('utilities.user-maintenance',[
                'librarian' => $this->getLibrarian(),
                'admin' => $this->getAdmin()
            ]);
        }

    }

    public function getAdmin()
    {
       return DB::table('tbl_users')
                ->where('user_type', 0)
                ->get();
    }

    public function getLibrarian()
    {
       return DB::table('tbl_users')
                ->where('user_type', 3)
                ->get();
    }


    public function displayStudent()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getStudent())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-user" user-id="'. $b->id .'" user-type="'. $b->user_type .'" 
                data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></a>';

                $button .= ' <a class="btn btn-sm btn-danger" id="btn-archive-user" user-id="'. $b->id .'" 
                data-toggle="modal" data-target="#archiveModal"><i class="fa fa-archive"></i></a>';

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
                ->where('archive_status', 0)
                ->get();
    }

    public function displayTeacher()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getTeacher())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-user" user-id="'. $b->id .'" user-type="'. $b->user_type .'" 
                data-toggle="modal" data-target="#editUserModal"><i class="fa fa-edit"></i></a>';

                $button .= ' <a class="btn btn-sm btn-danger" id="btn-archive-user" user-id="'. $b->id .'" 
                data-toggle="modal" data-target="#archiveModal"><i class="fa fa-archive"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }
    }

    public function getTeacher()
    {
       return DB::table('tbl_users as U')
                ->select('U.*', 'D.department')
                ->leftJoin('tbl_dept AS D', 'D.user_id', '=', 'U.user_id')
                ->where('user_type', 1)
                ->where('archive_status', 0)
                ->get();
    }

    public function store()
    {
        $data = Input::all();

        if($data['user_type'] == 0){
            if($this->isAdminExist($data['user_type']))
            {
                return redirect('/user-maintenance')->with('danger', 'Admin is already exists!'); 
            }
            else{
                $this->insertUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);       
            }
        }

        else{
            if($this->isUserExist($data['user_id']))
            {
                return redirect('/user-maintenance')->with('danger', 'Student is already exists!'); 
            }
            else{

                if($data['user_type'] == 1)
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
                else if($data['user_type'] == 3)
                {
                    $this->insertUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
                }
            
        
                return redirect('/user-maintenance')->with('success', 'Data Saved');
            }
        }
    }

    public function isAdminExist($user_type)
    {
        $row=DB::table('tbl_users')->where('user_type', $user_type);

        return $row->count() > 0 ? true : false;
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

    public function isUserExist($user_id)
    {
        $row = DB::table('tbl_users')->where('user_id', $user_id);

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    function import(Request $request)
    {
        $file = $request->file('file');
        $user_type = $request->input('user_type');

        base::CSVImporter($file, $user_type);
        $no_of_duplicates = \Session::get('NO_OF_DUPLICATES');

       if($no_of_duplicates>0)
       {
        return redirect('/user-maintenance')
        ->with('success', 'Student information imported successfully! There are '.$no_of_duplicates.' user is not imported because user already exists.');   
       }
       else
       {
        return redirect('/user-maintenance')
        ->with('success', 'Student information imported successfully!');   
       }
    }

    function export(Request $request)
    {

        if($request->input('user_type') == 1)
        {
            base::CSVExporter($this->getTeacherData(),1); 
        }else{
            base::CSVExporter($this->getStudentData(),2); 
        }       
    }

    public function getStudentData()
    {
       return DB::table('tbl_users as U')
                ->select('U.id', 'U.user_id', 'U.name', 'contact_no', 'address', 'grade')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->where('user_type', 2)
                ->where('archive_status', 0)
                ->get();
    }

    public function getTeacherData()
    {
        return DB::table('tbl_users as U')
                ->select('U.id', 'U.user_id', 'U.name', 'contact_no', 'address', 'department')
                ->leftJoin('tbl_dept AS D', 'D.user_id', '=', 'U.user_id')
                ->where('user_type', 1)
                ->where('archive_status', 0)
                ->get();
    }


    public function getUserDetails($user_id)
    {
       return DB::table('tbl_users as U')
                ->select('U.*', 'G.grade')
                ->leftJoin('tbl_grade AS G', 'G.user_id', '=', 'U.user_id')
                ->where('U.id', $user_id)
                ->get();
    }


    public function update()
    {
        $data = Input::all();

        if($data['user_type'] == 0)
        {
            $this->updateUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
        }
        else if($data['user_type'] == 1)
        {
            $this->updateUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);

            DB::table('tbl_dept')
            ->where('user_id', $data['user_id'])
            ->update([
                'department' => $data['department'],
            ]); 
        }
        else if($data['user_type'] == 2)
        {
            $this->updateUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
            
            DB::table('tbl_grade')
            ->where('user_id', $data['user_id'])
            ->update([
                'grade' => $data['grade'],
            ]); 
        }
        else if($data['user_type'] == 3)
        {
            $this->updateUser($data['user_id'], $data['name'], $data['password'], $data['contact_no'], $data['address'], $data['user_type']);
        }
       

        return redirect('/user-maintenance')->with('success', 'Data Saved');
    }

    public function updateUser($user_id, $name, $password, $contact, $address, $user_type)
    {
        if($password){
            DB::table('tbl_users')
            ->where('user_id', $user_id)
            ->update([          
                'name' => $name,
                'password' => Hash::make($password),
                'address' => $address,
                'contact_no' => $contact,
                'user_type' => $user_type
            ]); 
        }
        else{
            DB::table('tbl_users')
            ->where('user_id', $user_id)
            ->update([          
                'name' => $name,
                'address' => $address,
                'contact_no' => $contact,
                'user_type' => $user_type
            ]); 
        }
    }

    public function archive()
    {
        $data = Input::all();
        DB::table('tbl_users')
            ->where('id', $data['id_archive'])
            ->update([
                'archive_status' => 1,
                'updated_at' => date('Y-m-d h:m:s')
            ]);

        return redirect('/user-maintenance')->with('success', 'Student was archived successfully');
    }
}
