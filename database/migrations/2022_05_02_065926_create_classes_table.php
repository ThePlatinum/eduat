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
      $table->string('name');
      $table->string('level');
      $table->integer('fee');
      $table->timestamps();
    });

    // Create the graduated student's class
    DB::table('classes')->insert(array(
      array('id' => 1, 'name'=> 'Graduated', 'level'=> '0', 'fee'=> 0),
    ));
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
