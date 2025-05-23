<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\ReaderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->middleware('guest')->name('password.update');

Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/index', [IndexController::class, 'index'])->name("admin.index");

    Route::get('/categories', [CategoryController::class, 'index'])->name("category.index");
    Route::group(['prefix' => 'category'], function () {
        Route::get('/create', [CategoryController::class, 'create'])->name("category.create");
        Route::post('/store', [CategoryController::class, 'store'])->name("category.store");
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name("category.edit");
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name("category.update");
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name("category.delete");

    });

    Route::get('/publishers', [PublisherController::class, 'index'])->name("publisher.index");
    Route::group(['prefix' => 'publisher'], function () {
        Route::get('/create', [PublisherController::class, 'create'])->name("publisher.create");
        Route::post('/store', [PublisherController::class, 'store'])->name("publisher.store");
        Route::get('/edit/{id}', [PublisherController::class, 'edit'])->name("publisher.edit");
        Route::post('/update/{id}', [PublisherController::class, 'update'])->name("publisher.update");
        Route::get('/delete/{id}', [PublisherController::class, 'delete'])->name("publisher.delete");
    });

    Route::get('/authors', [AuthorController::class, 'index'])->name("author.index");
    Route::group(['prefix' => 'author'], function () {
        Route::get('/create', [AuthorController::class, 'create'])->name("author.create");
        Route::post('/store', [AuthorController::class, 'store'])->name("author.store");
        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name("author.edit");
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name("author.update");
        Route::get('/delete/{id}', [AuthorController::class, 'delete'])->name("author.delete");
    });

    Route::get('/books', [BookController::class, 'index'])->name("book.index");
    Route::group(['prefix' => 'book'], function () {
        Route::get('/create', [BookController::class, 'create'])->name("book.create");
        Route::post('/store', [BookController::class, 'store'])->name("book.store");
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name("book.edit");
        Route::post('/update/{id}', [BookController::class, 'update'])->name("book.update");
        Route::get('/delete/{id}', [BookController::class, 'delete'])->name("book.delete");
        Route::post('/excel-upload', [BookController::class, 'excel_upload'])->name("book.excel_upload");
        Route::get('/restore/{id}', [BookController::class, 'restore'])->name("book.restore");
        Route::get('/deleted', [BookController::class, 'deletedBooks'])->name("book.deleted");
        Route::get('/books/force-delete/{id}', [BookController::class, 'forceDelete'])->name('book.forceDelete');
        Route::post('/author-create', [BookController::class, 'authorCreate'])->name("book.authorCreate");
        Route::post('/publisher-create', [BookController::class, 'publisherCreate'])->name("book.publisherCreate");
        Route::post('/category-create', [BookController::class, 'categoryCreate'])->name("book.categoryCreate");
    });

    Route::get('/loans', [LoanController::class, 'index'])->name("loan.index");
    Route::group(['prefix' => 'loan'], function () {
        Route::get('/create', [LoanController::class, 'create'])->name("loan.create");
        Route::post('/store', [LoanController::class, 'store'])->name("loan.store");
        Route::get('/edit/{id}', [LoanController::class, 'edit'])->name("loan.edit");
        Route::get('/delete/{id}', [LoanController::class, 'delete'])->name("loan.delete");
        Route::post('/return/{id}', [LoanController::class, 'returnLoan'])->name("loan.return");
    });

    Route::get('/readers', [ReaderController::class, 'index'])->name("reader.index");
    Route::group(['prefix' => 'reader'], function () {
        Route::get('/create', [ReaderController::class, 'create'])->name("reader.create");
        Route::post('/store', [ReaderController::class, 'store'])->name("reader.store");
        Route::get('/edit/{id}', [ReaderController::class, 'edit'])->name("reader.edit");
        Route::post('/update/{id}', [ReaderController::class, 'update'])->name("reader.update");
        Route::get('/delete/{id}', [ReaderController::class, 'delete'])->name("reader.delete");
    });

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notification/read/{id}', [NotificationController::class, 'markRead'])->name('notification.markRead');

    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

});
