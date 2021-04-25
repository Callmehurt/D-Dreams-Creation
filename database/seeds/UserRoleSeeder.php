<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->truncate();
        $rows = [
            [
                'role_id' => '1',
                'user_id' => '1',
                'user_type' => '',
            ],[
                'role_id' => '2',
                'user_id' => '2',
                'user_type' => '',
            ],[
                'role_id' => '3',
                'user_id' => '3',
                'user_type' => '',
            ],
        ];
        DB::table('role_user')->insert($rows);
    }
}
