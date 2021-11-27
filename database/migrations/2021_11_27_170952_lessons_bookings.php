<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LessonsBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_bookings', function (Blueprint $table) {
            $table->id();
            $table->date('lesson_date');
            $table->enum('lesson_order', [1, 2, 3, 4, 5, 6, 7]);
            $table->unsignedBigInteger('audience_id');
            $table->foreign('audience_id')->references('id')->on('audiences');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->boolean('is_remote');
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
        Schema::dropIfExists('lessons_booking');
    }
}
