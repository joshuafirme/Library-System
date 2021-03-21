<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdatePenalty extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:penalty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update penalty if due';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('tbl_book_borrowed')
            ->whereRaw('due_date < CURDATE()')
            ->update([
                'is_penalty' => 1
            ]);  
            
        \Log::info("Penalty updated successfully!");
        info('Penalty updated successfully!');
    }
}
