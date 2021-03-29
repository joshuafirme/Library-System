<?php

namespace App\Helpers;
use DB;
use Auth;
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
    
}