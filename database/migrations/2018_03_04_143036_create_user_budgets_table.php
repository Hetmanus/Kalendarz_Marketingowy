<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateUserBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('editor')->unsigned()->references('id')->on('user'); 
            $table->double('value', 16, 2); 
            $table->string('comment', 500)->nullable();
            $table->integer('next')->unsigned()->references('id')->on('user_budget')->nullable()->unique();
            $table->integer('owner')->unsigned()->references('id')->on('user');
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
        Schema::dropIfExists('user_budgets');
    }
}
