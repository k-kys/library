<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOutOnLoan extends Model
{
    use HasFactory;
    protected $table = 'books_out_on_loan';

    protected $fillable = [
        'book_id',
        'student_id',
        'number',
        'date_borrowed',
        'date_expiration',
        'date_returned',
        'status',
        'amount_of_fine',
        'created_at',
        'updated_at',
    ];

    // Inverse từ model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Inverse từ model Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
