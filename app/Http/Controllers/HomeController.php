<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Author;
use App\Category;
use App\Publisher;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate(3);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.index')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function view_books()
    {
        $paginate = 9;
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate($paginate);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_books')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function view_book($id)
    {
        $book = Book::where('id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->first(); // Model
        
        $img_link = Storage::url($book->image);
    	$book->image = $img_link;

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.book')->with('book', $book)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function view_publisher_book($id)
    {
        $books = Book::where('publisher_id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate(3); // Model
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.publisher')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function view_author_book($id)
    {
        $books = DB::table('books')->join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->wherenull('books.deleted_at')
        ->where('authors.id', $id)->get();
        /*
        $books = Book::join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->where('authors.id', $id)->whereNull('books.deleted_at')->get();
        */
        // dd($books);
        
        foreach ($books as $book) {
                $img_link = Storage::url($book->image);
                $book->image = $img_link;
    	}

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.author')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function view_category_book($id)
    {
        $books = DB::table('books')->join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->wherenull('books.deleted_at')
        ->where('categories.id', $id)->get();
        // dd($books);
        
        foreach ($books as $book) {
                $img_link = Storage::url($book->image);
                $book->image = $img_link;
    	}

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.category')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }


    public function view_authors()
    {
        
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_authors')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }
    public function view_categories()
    {
        
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_categories')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }
    
    public function view_publishers()
    {
        
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_publishers')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function search()
    {
        $search_text = $_GET['search'];
        $books = DB::table('books')->join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')
        ->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->wherenull('books.deleted_at')
        ->where(function ($query) use ($search_text){
            $query->where('books.title', 'LIKE','%'. $search_text .'%');
            $query->orwhere('publishers.name', 'LIKE','%'. $search_text .'%');
            $query->orwhere('authors.name', 'LIKE','%'. $search_text .'%');
            $query->orwhere('categories.category', 'LIKE','%'. $search_text .'%');
        })
        ->get();

        foreach ($books as $book) {
            $img_link = Storage::url($book->image);
            $book->image = $img_link;
    }

    // for layouts/main.blade.php
    $categories = Category::select('id', 'category')->get();
    $publishers = Publisher::select('id', 'name')->get();
    $authors = Author::select('id', 'name')->get();

    return view('book.search')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }
}
