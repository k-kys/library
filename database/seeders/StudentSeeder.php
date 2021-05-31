<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Sinh viên 1',
            'email' => 'sinhvien1@gmail.com',
            'password' => bcrypt('123456'),
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
        Student::insert($data);
    }
}
