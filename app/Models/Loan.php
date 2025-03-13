<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = ['reader_id', 'admin_id', 'book_id', 'loan_date', 'due_date', 'return_date', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // İade tarihine kalan günleri hesaplayan accessor
    public function getDaysUntilDueAttribute()
    {
        if ($this->status == 'returned') {
            return 0;
        }
        return Carbon::now()->diffInDays(Carbon::parse($this->due_date), false);
    }
}