<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = User::create([
            'name' => 'Gabriel Cesar Mello',
            'email' => '95gabrielcesar@gmail.com',
            'password' => Hash::make('gabriel0203'),
        ]);

        $super->assignRole(['user', 'admin', 'super']);
    }
}
