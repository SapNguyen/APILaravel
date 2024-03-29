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

        Schema::create('cinemas', function (Blueprint $table) {
            $table->id('idphong');
            $table->string('name');
            $table->unsignedSmallInteger('amount_of_seat');
            $table->unsignedSmallInteger('seat_per_row');
            $table->boolean('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cinemas');
    }
};
