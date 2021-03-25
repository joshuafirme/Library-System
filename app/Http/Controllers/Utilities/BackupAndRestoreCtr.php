<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupAndRestoreCtr extends Controller
{
    public function index()
    {
        return view('utilities.backup-and-restore');
    }

    public function backup(){
        $filename = "backup-" . date('Y-m-d') . ".sql";

        $command = "".storage_path() . "/app/mysql/bin/mysqldump.exe"." --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output = NULL;

        exec($command, $output, $returnVar);

        return redirect('/backup-and-restore')->with('success', 'The database is successfully backup.');
    }

    public function restore(){
        $filename = "backup-" . date('Y-m-d') . ".sql";

        $command = "".storage_path() . "/app/mysql/bin/mysql.exe"." --user=" . env('DB_USERNAME') . " --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  < " . storage_path() . "/app/backup/" . $filename;

        $returnVar = NULL;
        $output = NULL;

        exec($command, $output, $returnVar);

        return redirect('/backup-and-restore')->with('success', 'The database is successfully restored.');
    }

}
