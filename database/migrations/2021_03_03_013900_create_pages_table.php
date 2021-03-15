<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('slug');
            $table->string('fontColor')->default('#000000');
            $table->string('bgType')->default('color');
            $table->string('bgValue')->default('#FFFFFF');
            $table->string('image')->default('default.png');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('fbPixel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
