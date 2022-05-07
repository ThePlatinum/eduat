<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentitemsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('studentitems', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('item_id');
      $table->unsignedBigInteger('student_id');
      $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
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
    Schema::dropIfExists('studentitems');
  }
}
