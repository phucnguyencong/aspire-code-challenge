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
            [
                'name' => 'creditor',
                'email' => 'creditor@gmail.com',
                'password' => bcrypt(123456),
            ],
            [
                'name' => 'debtor',
                'email' => 'debtor@gmail.com',
                'password' => bcrypt(123456),
            ],
        ]);
    }
}
