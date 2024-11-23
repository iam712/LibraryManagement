<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    use HasFactory;
    protected $tables = 'books';
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_year',
        'member_id',
        'borrowed_at',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
