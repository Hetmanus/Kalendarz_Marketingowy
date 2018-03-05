<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateActionBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('editor')->unsigned()->references('id')->on('user'); 
            $table->string('comment');             
            $table->double('value_MZ', 16, 2)->default(0);
            $table->double('value_RZiU', 16, 2);
            $table->double('value_RiMW', 16, 2);
            $table->double('value_EC', 16, 2);
            $table->integer('next')->unsigned()->references('id')->on('action_budget'); 
            $table->integer('action_shop')->unsigned()->references('id')->on('action_shops'); 
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
        Schema::dropIfExists('action_budgets');
    }
}
