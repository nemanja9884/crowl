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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->bigInteger('sentence_id')->index();
            $table->integer('user_id')->nullable();
            $table->string('ip_adress')->nullable();
            $table->enum('positive_answer', [0, 1])->default(0);
            $table->enum('negative_answer', [0, 1])->default(0);
            $table->string('negative_reasons')->nullable();
            $table->string('sentence_bad_part')->nullable();
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
        Schema::dropIfExists('answers');
    }
};
