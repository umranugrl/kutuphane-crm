<?php
namespace App\Notifications;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LoanDueNotification extends Notification
{
    use Queueable;

    protected $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function via()
    {
        return ['database']; // Veritabanı üzerinden bildirim gönder
    }

    public function toDatabase()
    {
        return [
            'message'          => "📢 Okuyucu {$this->loan->reader->reader_full_name}, '{$this->loan->book->title}' kitabı için son 1 gün!",
            'loan_id'          => $this->loan->id,
            'reader_full_name' => $this->loan->reader->reader_full_name,
            'title'            => $this->loan->book->title,
            'due_date'         => $this->loan->due_date,
        ];
    }
}
