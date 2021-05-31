<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $table = 'majors';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    // Many to many Relationship
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_major', 'major_id', 'book_id');
    }
}
