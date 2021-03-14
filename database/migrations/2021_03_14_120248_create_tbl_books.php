<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('_prefix');
            $table->integer('accession_no');
            $table->integer('old_accession');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->integer('category');
            $table->integer('sub_category');
            $table->string('edition');
            $table->string('no_of_pages');
            $table->double('amount_if_lost');
            $table->double('cost');
            $table->string('date_acq');
            $table->string('date_published');
            $table->integer('is_weed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_books');
    }
}
