<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reader extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','reader_full_name','email', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}