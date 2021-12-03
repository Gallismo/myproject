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
        Schema::create('users', function (Blueprint $table) {
           $table->id();
           $table->string('name');
           $table->string('login')->unique();
           $table->string('password');
           $table->unsignedBigInteger('teacher_id')->nullable()->unique();
           $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('SET NULL')->onUpdate('CASCADE');
           $table->string('jwt_token')->nullable();
           $table->boolean('is_admin')->default(0);
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
