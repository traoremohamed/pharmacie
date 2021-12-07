<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleSousmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_sousmenus', function (Blueprint $table) {

            $table->unsignedBigInteger('sousmenu_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('sousmenu_id')
                ->references('id_sousmenu')
                ->on('sousmenu')
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->primary(['sousmenu_id', 'role_id'], 'role_has_sousmenus_sousmenu_id_role_id_primary');
                });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_has_sousmenus');
    }
}
