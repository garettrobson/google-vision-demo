<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->mediumText('path')->notNull();
            $table->mediumText('thumbnail')->notNull();
            $table->string('file_name')->notNull();
            $table->string('mime_type')->notNull();
        });

        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('label');
        });

        Schema::create('image_label', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('label_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_labels');
        Schema::dropIfExists('labels');
        Schema::dropIfExists('images');
    }
}
