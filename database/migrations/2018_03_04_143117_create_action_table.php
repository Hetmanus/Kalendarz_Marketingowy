<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('creation_date')->default(Carbon::now());
            $table->string('name', 100);
            $table->string('detail', 1000);
            $table->dateTime('start');
            $table->dateTime('stop');
            $table->double('value_MZ', 16, 2)->default(0);
            $table->double('value_RZiU', 16, 2);
            $table->double('value_RiMW', 16, 2);
            $table->double('value_EC', 16, 2);
            $table->integer('creator')->unsigned()->references('id')->on('user'); 
            $table->integer('involved_shop')->unsigned()->references('id')->on('action_shop'); 
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
        Schema::dropIfExists('actions');
    }
}
