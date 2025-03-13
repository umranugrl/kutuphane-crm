<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password','profile_image'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function authors()
    {
        return $this->hasMany(Author::class);
    }

    public function publishers()
    {
        return $this->hasMany(Publisher::class);
    }
    public function readers()
    {
        return $this->hasMany(Reader::class);
    }
}
