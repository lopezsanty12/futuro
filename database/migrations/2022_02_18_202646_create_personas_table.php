<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_personas', function (Blueprint $table) {
            $table->id();
            $table->string('dpi');
            $table->string('nit');
            $table->string('nombres');
            $table->string('apellidos');
            $table->timestamp('debaja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gen_personas');
    }
};
