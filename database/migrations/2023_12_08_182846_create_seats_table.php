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
        Schema::create('seats', function (Blueprint $table) {
            $table->id('idghe');
            $table->unsignedBigInteger('idphong');
            $table->string('row');
            $table->unsignedSmallInteger('column');
            $table->boolean('isSelected');
            $table->boolean('isBooked');

            $table->foreign('idphong')->references('idphong')->on('cinemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
};
