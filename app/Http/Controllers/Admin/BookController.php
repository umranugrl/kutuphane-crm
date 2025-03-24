<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $searchTitle      = $request->input('title');
        $searchAuthorId   = $request->input('author_id');
        $searchIsbn       = $request->input('isbn');
        $searchCategoryId = $request->input('category_id');
        $searchStatus     = $request->input('status');

        $books = Book::with(['category', 'author', 'publisher'])
            ->leftJoin('loans as l', function ($join) {
                $join->on('books.id', '=', 'l.book_id')
                    ->whereRaw('l.id = (SELECT MAX(loans.id) FROM loans WHERE loans.book_id = books.id)');
            }) // Sadece en son ödünç alınan kaydını max ile alıyoruz
            ->select('books.*', 'l.status as loan_status')
            ->orderBy('books.title', 'asc');

        if ($searchTitle) {
            $books->where('books.title', 'like', "%$searchTitle%");
        }

        if ($searchAuthorId) {
            $books->where('books.author_id', $searchAuthorId);
        }

        if ($searchIsbn) {
            $books->where('books.isbn', 'like', "%$searchIsbn%");
        }

        if ($searchCategoryId) {
            $books->where('books.category_id', $searchCategoryId);
        }

        if ($searchStatus !== null) {
            if ($searchStatus == 'borrowed') {
                $books->where('l.status', 'borrowed'); // Ödünç alınan kitapları filtrele
            } elseif ($searchStatus == 'available') {
                $books->whereNull('l.status')->orWhere('l.status', '!=', 'borrowed'); // Müsait olan kitaplar
            }
        }

        $books = $books->distinct()->paginate(5)->appends($request->query());

        $authors    = Author::all();
        $categories = Category::all();

        return view('books.index', compact(['books', 'searchTitle', 'searchAuthorId', 'searchIsbn', 'searchCategoryId', 'searchStatus', 'authors', 'categories']));
    }

    public function create()
    {
        $categories = Category::all();  //kategorileri çekiyoruz
        $authors    = Author::all();    //yazarları çekiyoruz
        $publishers = Publisher::all(); // Yayın evlerini çekiyoruz
        return view('books.create', compact('categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:225|unique:books,title',
            'author_id'    => 'required|exists:authors,id',
            'year'         => 'required|integer:4|min:1000|max:2099',
            'isbn'         => 'required|string|max:13|unique:books,isbn',
            'category_id'  => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        Book::create([
            'user_id'      => auth()->id(),
            'title'        => $request->title,
            'author_id'    => $request->author_id,
            'year'         => $request->year,
            'isbn'         => $request->isbn,
            'category_id'  => $request->category_id,
            'publisher_id' => $request->publisher_id,
        ]);

        return redirect()->route('book.index');
    }

    public function edit($id)
    {
        $book       = Book::find($id);
        $categories = Category::all();
        $authors    = Author::all();
        $publishers = Publisher::all();
        return view('books.update', compact('book', 'categories', 'authors', 'publishers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:225|unique:books,title,' . $id,
            'author_id'    => 'required|exists:authors,id',
            'year'         => 'required|integer|min:1000|max:2099',
            'isbn'         => 'required|string|max:13|unique:books,isbn,' . $id,
            'category_id'  => 'required|exists:categories,id',
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        $book = Book::find($id);
        $book->update([
            'title'        => $request->title,
            'author_id'    => $request->author_id,
            'year'         => $request->year,
            'isbn'         => $request->isbn,
            'category_id'  => $request->category_id,
            'publisher_id' => $request->publisher_id,
        ]);

        return redirect()->route('book.index');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('book.index');
    }

    public function categoryCreate(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:225',
        ]);

        $category = Category::create([
            'category_name' => $request->category_name,
            'slug'          => Str::slug($request->category_name),
            'description'   => $request->description,
            'user_id'       => auth()->id(),
        ]);

        return response()->json([
            'success'  => true,
            'category' => $category,
        ]);
    }

    public function publisherCreate(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:225',
        ]);

        $publisher = Publisher::create([
            'user_id'        => auth()->id(),
            'publisher_name' => $request->publisher_name,
            'address'        => $request->address,
            'phone'          => $request->phone,
            'website'        => $request->website,
        ]);

        return response()->json([
            'success'   => true,
            'publisher' => $publisher,
        ]);
    }

    public function authorCreate(Request $request)
    {
        $request->validate([
            'full_name'  => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date|after:birth_date',
        ]);

        $author = Author::create([
            'user_id'    => auth()->id(),
            'full_name'  => $request->full_name,
            'birth_date' => $request->birth_date,
            'death_date' => $request->death_date,
        ]);

        return response()->json([
            'success' => true,
            'author'  => $author,
        ]);
    }
}
