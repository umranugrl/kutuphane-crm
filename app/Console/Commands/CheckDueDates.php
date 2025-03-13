<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use App\Models\User;
use App\Notifications\LoanDueNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class CheckDueDates extends Command
{
    protected $signature = 'check:duedates';
    protected $description = 'Ödünç süresi dolmak üzere olan kitaplar için bildirim gönderir.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $loansDueTomorrow = Loan::where('due_date', Carbon::now()->addDay()->toDateString())
            ->where('status', 'borrowed')
            ->with(['reader', 'book'])
            ->get();

        foreach ($loansDueTomorrow as $loan) {
            $admin = User::all();
            if ($admin) {
                Notification::send($admin, new LoanDueNotification($loan));
            }
        }

        $this->info('Bildirimler başarıyla gönderildi.');
    }
}