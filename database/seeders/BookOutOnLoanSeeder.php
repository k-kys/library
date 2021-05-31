<?php

namespace Database\Seeders;

use App\Models\BookOutOnLoan;
use Illuminate\Database\Seeder;

class BookOutOnLoanSeeder extends Seeder
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
            'student_id' => 1,
            'date_borrowed' => '2021-01-01',
            'date_expiration' => '2021-01-31',
            'created_at' => '2021-01-01',
            'updated_at' => '2021-01-01',
        ];
        BookOutOnLoan::insert($data);
    }
}
