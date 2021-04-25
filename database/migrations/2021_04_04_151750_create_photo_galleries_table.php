<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('photo_galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('tag');
            $table->string('image');
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('album_types')->onDelete('cascade');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('photo_galleries');
    }
}
