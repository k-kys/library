<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Văn học',
            'created_at' => '2020-12-01',
            'updated_at' => '2020-12-01',
        ];
        Major::insert($data);
    }
}
