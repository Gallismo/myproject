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
            $table->unsignedBigInteger('lesson_order_id')->nullable();
            $table->foreign('lesson_order_id')->references('id')->on('lessons_orders')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('SET NULL')->onUpdate('CASCADE');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('SET NULL')->onUpdate('CASCADE');
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
