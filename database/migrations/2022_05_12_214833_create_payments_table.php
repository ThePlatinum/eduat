<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('student_id');
      $table->unsignedBigInteger('class_id');
      $table->integer('receipt_number')->nullable();
      $table->string('ammount');
      $table->string('note')->nullable();
      $table->timestamps();
      $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('payments');
  }
}
