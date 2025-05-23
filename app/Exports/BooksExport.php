<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithHeadings, WithMapping
{
   
    public function collection()
    {
        return Book::with(['author', 'publisher', 'category','loans'])->get();
    }

    public function headings(): array
    {
        return [
            'Kitap Adı','Yazar','Yıl','Yayın Evi','ISBN','Kategori Adı','Durum',
        ];
    }

    public function map($book): array
    {
        $lastLoan = $book->loans->sortByDesc('loan_date')->first();
        $status = ($lastLoan && $lastLoan->status === 'borrowed') ? 'Ödünç Alındı' : 'Uygun';

        return [
            $book->title,
            optional($book->author)->full_name ?? '-',
            $book->year,
            optional($book->publisher)->publisher_name ?? '-',
            $book->isbn,
            optional($book->category)->category_name ?? '-',
            $status,
        ];
    }
}
