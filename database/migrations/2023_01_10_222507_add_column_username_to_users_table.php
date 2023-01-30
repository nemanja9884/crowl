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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('name');
            $table->string('age')->after('username');
            $table->boolean('working_on_university')->after('age')->default(false);
            $table->boolean('language_teacher')->after('working_on_university')->default(false);
            $table->boolean('dominant_language')->after('language_teacher')->default(false);
            $table->string('language')->after('dominant_language')->nullable();
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
