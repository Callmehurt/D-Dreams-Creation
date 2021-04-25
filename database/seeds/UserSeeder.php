<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $rows = [
            [
                'name' => 'Techxbay',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Sandeep',
                'email' => 'sandeepshrestha0123@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Test User',
                'email' => 'test@gmail.com',
                'password' => bcrypt('password'),
            ],
        ];
        DB::table('users')->insert($rows);
    }
}
