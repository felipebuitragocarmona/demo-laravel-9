<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Ingresar nombre de la tabla como se llamará en la BD
        Configurar cada uno de las columnas con respectivos
        Tipos de datos. Ampliar información en:
        https://laravel.com/docs/9.x/migrations#columns     
        */
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('method');
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
        //
    }
}
