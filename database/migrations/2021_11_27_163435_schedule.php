<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Schedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->enum('week_day', ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота']);
            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед', 'Классный час']);
            $table->time('start_time')->default(1);
            $table->time('end_time')->default(1);
            $table->integer('break')->default(0)->nullable();
            $table->timestamps();
        });



//        Weekdays schedule tables create
//        Schema::create('weekdays_economic_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('weekdays_technology_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('weekdays_remote_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//
//
////        Tuesday schedule tables create
//        Schema::create('tuesday_economic_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед', 'Классный час'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('tuesday_technology_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед', 'Классный час'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('tuesday_remote_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 5, 6, 7, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//
//
////      Saturday schedule tables create
//        Schema::create('saturday_economic_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('saturday_technology_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4, 'Обед'])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
//        Schema::create('saturday_remote_schedule', function (Blueprint $table) {
//            $table->id();
//            $table->enum('order_value', [1, 2, 3, 4])->unique();
//            $table->time('start_time')->default(1);
//            $table->time('end_time')->default(1);
//            $table->integer('break')->default(0)->nullable();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
//        Schema::dropIfExists('weekdays_remote_schedule');
//        Schema::dropIfExists('weekdays_economic_schedule');
//        Schema::dropIfExists('weekdays_technology_schedule');
//
//        Schema::dropIfExists('tuesday_remote_schedule');
//        Schema::dropIfExists('tuesday_technology_schedule');
//        Schema::dropIfExists('tuesday_economic_schedule');
//
//        Schema::dropIfExists('saturday_remote_schedule');
//        Schema::dropIfExists('saturday_technology_schedule');
//        Schema::dropIfExists('saturday_economic_schedule');
    }
}
