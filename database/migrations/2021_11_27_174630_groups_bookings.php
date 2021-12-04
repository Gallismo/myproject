<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GroupsBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->foreign('booking_id')->references('id')->on('lessons_bookings')->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('SET NULL')->onUpdate('CASCADE');

            $table->unsignedBigInteger('group_part_id')->nullable();
            $table->foreign('group_part_id')->references('id')->on('groups_parts')->onDelete('SET NULL')->onUpdate('CASCADE');
//            $table->unsignedBigInteger('group_id_second')->nullable();
//            $table->foreign('group_id_second')->references('id')->on('groups');
//
//            $table->unsignedBigInteger('group_id_third')->nullable();
//            $table->foreign('group_id_third')->references('id')->on('groups');
//
//            $table->unsignedBigInteger('group_id_fourth')->nullable();
//            $table->foreign('group_id_fourth')->references('id')->on('groups');

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
        //
    }
}
