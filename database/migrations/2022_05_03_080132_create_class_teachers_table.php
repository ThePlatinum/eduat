<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_teachers', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('class_id');
          $table->unsignedBigInteger('teacher_id');
          $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
          $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('class_teachers');
    }
}
