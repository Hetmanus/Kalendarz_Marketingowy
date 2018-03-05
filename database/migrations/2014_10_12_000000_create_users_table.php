<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login', 50)->unique();
            $table->string('salt', 60);
            $table->string('name', 40);
            $table->string('secound_name', 40);
            $table->string('detail', 500);
            $table->string('email', 100);
            //$table->rememberToken();
            //$table->timestamps();
            $table->integer('budget_history')->unique()->nullable()->default(null);
            $table->binary('concept_flag', 256)->nullable()->default(null);
            $table->boolean('is_specialist')->default(false);
            $table->boolean('is_admin')->default(false);
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
        Schema::dropIfExists('users');
    }
}
