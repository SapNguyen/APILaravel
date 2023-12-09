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
        Schema::create('shows', function (Blueprint $table) {
            $table->id('idshow');
            $table->unsignedBigInteger('idphong');
            $table->unsignedBigInteger('idphim');
            $table->dateTime('start_time');

            $table->foreign('idphong')->references('idphong')->on('cinemas');
            $table->foreign('idphim')->references('idphim')->on('films');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shows');
    }
};
