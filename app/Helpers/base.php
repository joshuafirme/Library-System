<?php

namespace App\Helpers;
use DB, Auth, Session;
class base
{
    public static function getName()
    {
       return DB::table('tbl_users')->where('id', Auth::id())->value('name');
    }

    public static function getUserType()
    {
       return DB::table('tbl_users')->where('id', Auth::id())->value('user_type');
    }

    public static function getPenaltyDays()
    {
       return DB::table('tbl_penalty')->value('days');
    }

    public static function getPenaltyAmount()
    {
       return DB::table('tbl_penalty')->value('penalty');
    }

    public static function getBorrowerName($id)
    {
       return DB::table('tbl_users')->where('id', $id)->value('name');
    }

    public static function hasOneLeftBook($accession_no)
    {
        $row = DB::table('tbl_books as B')
                ->where('B.accession_no', $accession_no)
                ->where('copies', 1)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function isBookAlreadyReserved($user_id, $accession_no)
    {
        $row = DB::table('tbl_book_reserve')
                ->where('user_id', $user_id)
                ->where('accession_no', $accession_no)
                ->get();

        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function isLimitReached()
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', Auth::id())
                ->where('status', 0)
                ->get();
                
        if($row->count() == 3){
            return true;
        }else{
            return false;
        }
    }

    public static function isAlreadyBorrowed($id, $accession_no)
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', $id)
                ->where('accession_no', $accession_no)
                ->where('status', 0)
                ->get();
                
        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function recordAction($user_id, $module, $action)
    {
        DB::table('tbl_audit_trail')
            ->insert([
                'user_id' => $user_id,
                'module' => $module,
                'action' => $action,
                'created_at' => date('Y-m-d h:m:s')
            ]);
    }
    
    public static function convertDataToHTML($report_data, $date_from, $date_to, $report_title)
    {
        
        $output = '
        <style>
            .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            }
        </style>
        <img class="center" src="img/logo.png" style="width:100px;">

        <div style="width:100%">
        
        <p style="text-align:right;">Date: '. date("M/d/Y", strtotime($date_from)) .' - '. date("M/d/Y", strtotime($date_to)).'</p>
        <h1 style="text-align:center;">'.$report_title.' Report</h1>

        <table width="100%" style="border-collapse:collapse; border: 1px solid;">
                      
            <thead>
                <tr>
                    <th style="border: 1px solid;">User ID</th>    
                    <th style="border: 1px solid;">Borrower</th>    
                    <th style="border: 1px solid;">Contact Number</th>     
                    <th style="border: 1px solid;">Accession No</th>
                    <th style="border: 1px solid;">Title</th>
                    <th style="border: 1px solid;">Date time borrowed</th>
                    <th style="border: 1px solid;">Due Date</th> 
            </thead>
            <tbody>
                ';

    
            if($report_data){
                foreach ($report_data as $data) {
                       
                if($data->is_penalty==1){
                    $penalty = "Yes";
                }else{
                    $penalty = "No";
                }
                    $output .='
                    <tr>  
                    <td style="border: 1px solid; padding:10px;">'. $data->user_id .'</td>      
                    <td style="border: 1px solid; padding:10px;">'. $data->name .'</td>                     
                    <td style="border: 1px solid; padding:10px;">'. $data->contact_no .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->accession_no.'</td>  
                    <td style="border: 1px solid; padding:10px;">'. $data->title .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->created_at .'</td>
                    <td style="border: 1px solid; padding:10px;">'. $data->due_date .'</td>             
                </tr>
                ';
                
                } 
            }
            else{
                echo "No data found";
            }
        
          
            $output .='
            </tbody>
        </table>
    
            </div>';
    
        return $output;
    }


    public static function CSVImporter($file, $table_import)
    {
         // File Details 
         $filename = $file->getClientOriginalName();
         $extension = $file->getClientOriginalExtension();
         $tempPath = $file->getRealPath();
         $fileSize = $file->getSize();
         $mimeType = $file->getMimeType();
   
         // Valid File Extensions
         $valid_extension = array("csv");
   
         // 2MB in Bytes
         $maxFileSize = 2097152; 
   
         // Check file extension
         if(in_array(strtolower($extension),$valid_extension)){
   
           // Check file size
           if($fileSize <= $maxFileSize){
   
             // File upload location
             $location = 'uploads';
   
             // Upload file
             $file->move($location,$filename);
   
             // Import CSV to Database
             $filepath = public_path($location."/".$filename);
   
             // Reading file
             $file = fopen($filepath,"r");
   
             $importData_arr = array();
             $i = 0;
   
             while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                   $i++;
                   continue; 
                }
                for ($c=0; $c < $num; $c++) {
                   $importData_arr[$i][] = $filedata [$c];
                }
                $i++;
             }
             fclose($file);
   
             if($table_import == 'book')
             {
                self::importBook($importData_arr);
             }
             else if($table_import == 'student')
             {
                self::importStudent($importData_arr);
             }
             else
             {
              //  self::importTeacher($importData_arr);
             }
             

   
             Session::flash('message','Import Successful.');
           }else{
             Session::flash('message','File too large. File must be less than 2MB.');
           }
   
         }else{
            Session::flash('message','Invalid File Extension.');
         }
    }


    public static function importBook($importData_arr)
    {
    
        foreach($importData_arr as $data_col)
        {
                 
            $category_id = self::getCategoryID($data_col[5], $data_col[12]);
                    
            DB::table('tbl_books')
                ->insert([
                    'accession_no' => $data_col[0],
                    'title' => $data_col[1],
                    'author' => $data_col[2],
                    'publisher' => $data_col[3],
                    'copies' => $data_col[4],
                    'category_id' => $category_id,
                    'edition' => $data_col[6],
                    'no_of_pages' => $data_col[7],
                    'amount_if_lost' => $data_col[8],
                    'cost' => $data_col[9],
                    'date_acq' => date("Y-m-d", strtotime($data_col[10])),
                    'date_published' => date("Y-m-d", strtotime($data_col[11])),
                    'is_weed' => 0
                ]);     
   
        }    
       
    }

    public static function importStudent($importData_arr)
    {
    
        foreach($importData_arr as $data_col)
        {            
                    
            DB::table('tbl_books')
                ->insert([
                    'user_id' => $data_col[0],
                    'name' => $data_col[1],
                    'password' => \Hash::make($data_col[0]),
                    'contact_no' => $data_col[2],
                    'address' => $data_col[3],
                    'user_type' => 2,
                    'archive_statis' => 0
                ]);     
        }    
       
    }
    
    public static function getCategoryID($category, $classification)
    {
      return DB::table('tbl_category')
                ->where('category', $category)
                ->where('classification', $classification)
                ->value('id');
    }
    
}