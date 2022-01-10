<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'admin'    => '管理者',
            'user0001' => 'テスト0001',
            'user0002' => 'テスト0002',
            'user0003' => 'テスト0003',
            'user0004' => 'テスト0004',
        ];

        foreach ($users as $id => $name) {
            User::create([
                'name'     => $name,
                'email'    => $id .'@example.com',
                'password' => bcrypt('99999999')
            ]);
        }
    }
}
