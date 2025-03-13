<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Reader;

class IndexController extends Controller
{
    public function index()
    {
        $categoryCount = Category::count();
        $bookCount     = Book::count();
        $authorCount   = Author::count();
        $readerCount   = Reader::count();

        return view('admins.index', compact('categoryCount', 'bookCount', 'authorCount', 'readerCount'));
    }
}
