<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Mắt biếc',
            'description' => 'Sách kể về Ngạn và Hà Lan abc',
            'price' => '110000',
            'amount' => '50',
            'stock_amount' => '49',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
        Book::insert($data);
    }
}
