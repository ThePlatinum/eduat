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
      $table->unsignedBigInteger('paid_in_class_id');
      $table->unsignedBigInteger('paid_in_term_id');
      $table->string('receipt_number')->nullable()->unique();
      $table->string('ammount');
      $table->string('note')->nullable();
      $table->timestamp('paydate');
      $table->timestamps();
      $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
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
