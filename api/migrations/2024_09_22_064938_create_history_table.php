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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('duty_id');
            $table->date('date_completed');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('student')->onDelete('cascade');
            $table->foreign('duty_id')->references('id')->on('duties')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('history');
    }
};
