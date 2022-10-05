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
        Schema::create('sentences', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->string('sentence')->index();
            $table->integer('positive_answers')->default(0)->index();
            $table->integer('negative_answers')->default(0)->index();
            $table->integer('total_answers')->default(0)->index();
            $table->decimal('word_reliability')->default(0)->index();
            $table->bigInteger('external_id');
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
        Schema::dropIfExists('sentences');
    }
};
