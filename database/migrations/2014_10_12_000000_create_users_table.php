<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
      $table->string('email')->unique();

      $table->string('firstname');
      $table->string('lastname');
      $table->string('othername')->nullable();

      $table->string('qualification')->nullable();

      $table->string('phone')->nullable();
      $table->string('address')->nullable();
      $table->string('gender')->nullable();
      $table->string('image')->default('avater.png');
      $table->string('bio')->default('No profile details');
      $table->timestamp('dob')->nullable();
      
      $table->unsignedBigInteger('klass_id')->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
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
  }
}
