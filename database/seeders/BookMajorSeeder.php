<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BookMajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'book_id' => 1,
            'major_id' => 1,
        ];
        DB::table('book_major')->insert($data);
    }
}
