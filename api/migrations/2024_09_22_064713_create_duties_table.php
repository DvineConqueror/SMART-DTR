<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutiesTable extends Migration
{
    public function up()
    {
        Schema::create('duties', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('room');
            $table->unsignedBigInteger('teacher_id');
            $table->date('date');
            $table->time('time');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('duties');
    }
}