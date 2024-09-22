<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('school_email')->unique();
            $table->string('password');
            $table->string('student_id')->unique();
            $table->string('mobile_number');
            $table->date('birthdate');
            $table->integer('year_level');
            $table->enum('sex', ['male', 'female']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student');
    }
};
