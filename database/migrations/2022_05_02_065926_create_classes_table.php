<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('classes', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->integer('level')->unique();
      $table->json('fees');
      $table->timestamps();
    });

    // Create the graduated student's class
    DB::table('classes')->insert(array(
      'name'=> 'Graduated', 'level'=> 0, 'fees'=> "[0,0,0]"),
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('classes');
  }
}
