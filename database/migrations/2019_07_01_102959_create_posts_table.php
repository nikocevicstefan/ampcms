<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('author_id');
            $table->string('cover_photo');
            $table->string('alt_tag');
            $table->string('thumbnail');
            $table->string('title');
            $table->text('introductory_content');
            $table->text('main_content');
            $table->string('tags');
            $table->boolean('is_published')->default(false);
            $table->unsignedInteger('views')->default(0);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
