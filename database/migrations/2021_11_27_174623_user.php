<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('login')->unique();
           $table->string('password');
           $table->unsignedBigInteger('role_id')->nullable();
           $table->foreign('role_id')->references('id')->on('roles')->onDelete('SET NULL')->onUpdate('CASCADE');
           $table->unsignedBigInteger('group_id')->nullable();
           $table->foreign('group_id')->references('id')->on('groups')->onDelete('SET NULL')->onUpdate('CASCADE');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
