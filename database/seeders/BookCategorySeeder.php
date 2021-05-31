<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class BookCategorySeeder extends Seeder
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
            'category_id' => 1,
        ];
        DB::table('book_category')->insert($data);
    }
}
