<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateActionShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop')->unsigned()->references('id')->on('shop'); 
            $table->integer('creator')->unsigned()->references('id')->on('user'); 
            $table->boolean('shop_type')->nullable(); 
            $table->integer('budget')->unsigned()->references('id')->on('action_budget')->nullable(); 
            $table->integer('next')->unsigned()->references('id')->on('action_shop'); 
            $table->integer('action')->unsigned()->references('id')->on('action'); 
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
        Schema::dropIfExists('action_shops');
    }
}
