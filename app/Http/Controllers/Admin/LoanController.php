<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Reader;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $searchStatus = $request->input('status');

        $loans = Loan::query()->with(['book', 'reader', 'admin']);

        if ($searchStatus !== null) {
            if ($searchStatus == 'borrowed') {
                $loans->where('status', 'borrowed');
            } elseif ($searchStatus == 'returned') {
                $loans->where('status', 'returned');
            }
        }

        $loans = $loans->paginate(5)->appends($request->query());

        return view('loans.index', compact('loans', 'searchStatus'));
    }

    public function create()
    {
        // Ödünç verilmemiş veya iade edilmiş kitapları getirme
        $books = Book::leftJoin('loans', 'books.id', '=', 'loans.book_id')
            ->where(function ($query) {
                // Hiç ödünç verilmemiş kitaplar veya iade edilmiş kitaplar
                $query->whereNull('loans.status')
                    ->orWhere('loans.status', 'returned');
            })
            ->whereNotIn('books.id', function ($query) {
                // Ödünç alınan kitapları hariç tutuyoruz
                $query->select('book_id')
                    ->from('loans')
                    ->where('status', 'borrowed');
            })
            ->distinct() // Kitapların tekrar etmesini engeller
            ->select('books.*')
            ->get();

        $readers = Reader::all();
        $users   = User::all();

        return view('loans.create', compact('books', 'users', 'readers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reader_id' => 'required|exists:readers,id',
            'book_id'   => 'required|exists:books,id',
            'loan_date' => 'nullable|date',
        ]);

        // Kitap zaten ödünç alınmış mı diye kontrol edelim
        $existingLoan = Loan::where('book_id', $request->book_id)
            ->where('status', 'borrowed')
            ->first();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'This book is already borrowed.');
        }

        // Kullanıcı tarih seçmezse bugünün tarihi atanacak
        $loanDate = $request->loan_date ?? now()->toDateString();
        $dueDate = now()->addDays(1)->toDateString();

        Loan::create([
            'reader_id' => $request->reader_id,
            'book_id'   => $request->book_id,
            'admin_id'  => auth()->id(),
            'loan_date' => $loanDate,
            'due_date'  => $dueDate,
            'status'    => 'borrowed',
        ]);

        return redirect()->route('loan.index');
    }

    public function returnLoan($id)
    {
        $loan = Loan::find($id);
        if ($loan->status === 'borrowed') {
            $loan->update([
                'status'      => 'returned',
                'return_date' => now(),
            ]);
            return redirect()->route('loan.index');
        }

        return redirect()->route('loan.index');
    }
}
