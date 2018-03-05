<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('detail', 500);
            //adres online of shop, if null this shop cant be online
            $table->string('adr_online', 500)->nullable();
            //adres offline of shop, if null this shop cant be offline
            $table->string('adr_offline', 500)->nullable();   
            //concept that this shop belongs to
            $table->tinyInteger('shop_concept')->unsigned()->references('id')->on('concept');          
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
        Schema::dropIfExists('shops');
    }
}
