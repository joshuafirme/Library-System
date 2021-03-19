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

    public static function getBorrowerName($id)
    {
       return DB::table('tbl_users')->where('id', $id)->value('name');
    }

    public static function hasOneLeftBook($accession_no)
    {
        $row = DB::table('tbl_books')
                ->where('accession_no', $accession_no)
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
                ->where('is_returned', 0)
                ->get();
                
        if($row->count() == 3){
            return true;
        }else{
            return false;
        }
    }

    public static function isAlreadyBorrowed($id)
    {
        $row = DB::table('tbl_book_borrowed')
                ->where('user_id', $id)
                ->where('is_returned', 0)
                ->get();
                
        if($row->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    
}