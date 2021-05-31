<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Quản trị 1',
                'email' => 'quantri1@gmail.com',
                'password' => bcrypt('123456'),
                'isSuperAdmin' => 1,
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ], [
                'name' => 'Nhân viên 1',
                'email' => 'nhanvien1@gmail.com',
                'password' => bcrypt('123456'),
                'isSuperAdmin' => 0,
                'created_at' => '2021-01-01',
                'updated_at' => '2021-01-01',
            ],
        ];
        Admin::insert($data);
    }
}
