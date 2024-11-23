<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    use HasFactory;
    protected $tables = 'members';
    protected $fillable = ['name', 'email', 'phone_number', 'address'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
