<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('mime');
            $table->bigInteger('size');
            $table->integer('uploader')->unsigned();
            $table->foreign('uploader')->references('id')->on('users')->onDelete('cascade');
            $table->string('original_name');
            $table->string('url');
            $table->string('extension');
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
        Schema::create('files');
    }
}
