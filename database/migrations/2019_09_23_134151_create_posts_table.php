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
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 256);
            $table->string('slug', 256);
            $table->string('subtitle', 384)->nullable();
            $table->text('content');
            $table->string('cover', 256)->nullable();
            $table->integer('views')->default(0);
            $table->dateTime('posted_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->index(["user_id"], 'fk_posts_users');
            $table->foreign('user_id', 'fk_posts_users')
                ->references('id')->on('users')
                ->onDelete('no action')
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
        Schema::dropIfExists('posts');
    }
}
