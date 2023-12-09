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
        Schema::create('seat_statuses', function (Blueprint $table) {
            $table->id('id_status');
            $table->unsignedBigInteger('idshow');
            $table->unsignedBigInteger('idghe');
            $table->boolean('isSelected');
            $table->boolean('isBooked');

            $table->foreign('idghe')->references('idghe')->on('seats');
            $table->foreign('idshow')->references('idshow')->on('shows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_statuses');
    }
};
