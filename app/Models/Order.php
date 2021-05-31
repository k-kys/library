<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['book_id', 'student_id', 'number'];

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
