<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_providers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('token', 512);
            $table->string('refresh_token', 512)->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->nullable();

            $table->timestamps();

            $table->index(["user_id"], 'fk_users_providers_users');
            $table->foreign('user_id', 'fk_users_providers_users')
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
        Schema::dropIfExists('users_providers');
    }
}
