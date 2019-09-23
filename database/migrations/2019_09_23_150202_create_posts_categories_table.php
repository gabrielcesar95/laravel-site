<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_categories', function (Blueprint $table) {
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();

            $table->index(["category_id"], 'fk_posts_categories_categories');
            $table->foreign('category_id', 'fk_posts_categories_categories')
                ->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->index(["post_id"], 'fk_posts_categories_posts');
            $table->foreign('post_id', 'fk_posts_categories_posts')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_categories');
    }
}
