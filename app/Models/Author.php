<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','full_name', 'birth_date', 'death_date'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}