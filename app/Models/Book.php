<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Book\BookRepositoryEloquent;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';

    protected $fillable = [
        'isbn',
        'name',
        'description',
        'price',
        'amount',
        'stock_amount',
        'img',
        'created_at',
        'updated_at',
    ];

    // Inverse từ model Category
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Inverse từ model Major
    public function majors()
    {
        return $this->belongsToMany(Major::class);
    }

    // One to Many Relationship
    public function books_out_on_loan()
    {
        return $this->hasMany(BookOutOnLoan::class, 'book_id', 'id');
    }

    // One to Many Relationship
    public function orders()
    {
        return $this->hasMany(Order::class, 'book_id', 'id');
    }

    /**
     * Filter function
     */
    public function filterCategory($value)
    {
        if ($value) return $value;
        return null;
    }

    public function filterMajor($value)
    {
        if ($value) return $value;
        return '*';
    }
}
