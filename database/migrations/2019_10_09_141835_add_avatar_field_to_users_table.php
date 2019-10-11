<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
//            $table->string('provider_name')->nullable()->after('id');
//            $table->string('provider_id')->nullable()->after('provider_name');
            $table->string('avatar')->nullable()->after('email');
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->change();
//            $table->dropColumn(['provider_name', 'provider_id', 'avatar']);
            $table->dropColumn('avatar');
        });
    }
}
