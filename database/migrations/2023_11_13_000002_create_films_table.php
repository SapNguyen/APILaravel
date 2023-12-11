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
        Schema::create('films', function (Blueprint $table) {
            $table->id('idphim');
            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->date('release_date');
            $table->date('end_date');
            $table->integer('runtime');
            $table->string('age_validation');
            $table->string('genre');
            $table->string('director');
            $table->string('actor');
            $table->string('language');
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
        Schema::dropIfExists('films');
    }
};
