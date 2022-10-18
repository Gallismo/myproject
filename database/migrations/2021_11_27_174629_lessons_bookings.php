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
            $table->unsignedBigInteger('lesson_order_id');
            $table->foreign('lesson_order_id')->references('id')->on('lessons_orders')->onUpdate('CASCADE');
            $table->unsignedBigInteger('audience_id');
            $table->foreign('audience_id')->references('id')->on('audiences')->onUpdate('CASCADE');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('CASCADE');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users')->onUpdate('CASCADE');
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('CASCADE');
            $table->unsignedBigInteger('group_part_id');
            $table->foreign('group_part_id')->references('id')->on('groups_parts')->onUpdate('CASCADE');
            $table->boolean('is_remote')->default(0);
            $table->string('conference_url')->nullable();
            $table->string('lesson_topic')->nullable();
            $table->string('lesson_homework')->nullable();
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
