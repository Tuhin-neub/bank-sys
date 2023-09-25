<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'MD. User',
            'balance' => '0',
            'role_id' => '5',
            'email' => 'user@dlab.com',
            'password' => bcrypt('dlabuser'),
            'status' => '1',
        ]);
        DB::table('users')->insert([
            'name' => 'MD. User1',
            'balance' => '00',
            'role_id' => '5',
            'email' => 'user1@dlab.com',
            'password' => bcrypt('dlabuser1'),
            'status' => '1',
        ]);
    }
}