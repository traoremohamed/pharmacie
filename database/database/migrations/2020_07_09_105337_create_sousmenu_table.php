<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSousmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sousmenu', function (Blueprint $table) {
            $table->bigIncrements('id_sousmenu');
            $table->integer('menu_id_menu')->unsigned();
            $table->string("sousmenu");
            $table->timestamps();
            $table->foreign('menu_id_menu')->references('id_menu')->on('menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sousmenu');
    }
}
