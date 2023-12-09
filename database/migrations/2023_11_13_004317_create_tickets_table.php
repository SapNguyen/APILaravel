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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('idve');
            $table->float('cost');
            $table->unsignedBigInteger('idghe');
            $table->unsignedBigInteger('idshow');
            $table->unsignedBigInteger('idtk');

            $table->foreign('idshow')->references('idshow')->on('shows');
            $table->foreign('idtk')->references('idtk')->on('users');
            $table->foreign('idghe')->references('idghe')->on('seats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
