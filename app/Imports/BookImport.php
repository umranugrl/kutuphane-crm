<?php

namespace App\Imports;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    */
   public function model(array $row)
    { 
        if (
            empty($row['kitap_adi']) ||
            empty($row['yazar']) ||
            empty($row['yil']) ||
            empty($row['yayin_evi']) ||
            empty($row['isbn']) ||
            empty($row['kategori_adi'])
        ) {
            return null; 
        }

        $existing = Book::where('isbn', $row['isbn'])->first();
        if ($existing) {
            return null;
        }

       $author = Author::firstOrCreate(
            ['full_name' => $row['yazar']],
            ['user_id' => auth()->id()]
        );
        $publisher = Publisher::firstOrCreate(
            ['publisher_name' => $row['yayin_evi']],
            ['user_id' => auth()->id()] 
        );
        $category = Category::firstOrCreate(
            ['category_name' => $row['kategori_adi']],
            ['user_id' => auth()->id(),
            'slug' => Str::slug($row['kategori_adi'])]
        );

        return new Book([
            'user_id' => auth()->id(),
            'title' => $row['kitap_adi'],
            'author_id' => $author->id,
            'year' => $row['yil'],
            'publisher_id' => $publisher->id,
            'isbn' => $row['isbn'],
            'category_id' => $category->id,
            'status' => 'available',
        ]);
    }
}
