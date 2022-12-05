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
        Schema::create('answer_details', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->bigInteger('answer_id')->index();
            $table->string('reason')->nullable();
            $table->text('sentence_bad_part')->nullable();
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
        Schema::dropIfExists('answer_details');
    }
};
