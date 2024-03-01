<?php

use Illuminate\Database\Schema\Blueprint;
use MrEssex\CubexSkeleton\System\Database\Migration;

class Example extends Migration
{
  public function up()
  {
    $this->schema->create('example', function (Blueprint $table) {
      // Auto-increment id
      $table->increments('id');

      $table->string('title');
      $table->string('description');

      // Required for Eloquent's created_at and updated_at columns
      $table->timestamps();

      $table->softDeletes();
    });
  }

  public function down()
  {
    $this->schema->drop('example');
  }
}
