<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentClassesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('student_classes', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('subject_id');
      $table->unsignedBigInteger('student_id');
      $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
      $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
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
    Schema::dropIfExists('student_classes');
  }
}
