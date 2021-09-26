<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\BookRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PublisherRequest;
use App\Book;
use App\Author;
use App\BooksAuthor;
use App\Publisher;
use App\Category;
use App\BooksCategory;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function Deleted(){
        $paginate = 2;
        $books = Book::onlyTrashed('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate($paginate);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('admin.deleted_books')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }
    public function index(){
        $paginate = 2;
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate($paginate);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('admin.index')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function create_book(){
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

    	return view('admin.create_book')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function store_book(BookRequest $request) {
        $image = $request->file('image');
		$path = 'uploads/images/';
		$name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
		Storage::disk('local')->put($path.$name , file_get_contents($image));
		Storage::disk('local')->exists($path.$name);

		// store in DB
        $title = $request['title'];
        $description = $request['description'];
		$published_year = $request['published_year'];
		$published_number = $request['published_number'];
		$publisher_id = $request['publisher_id'];
		$author_id = $request['author_id'];
		$category_id = $request['category_id'];

		$book = new Book();
		$book->title = $title;
        $book->image = $path.$name;
		$book->description = $description;
		$book->published_year = $published_year;
		$book->published_number = $published_number;
		$book->publisher_id = $publisher_id;
        $book_result = $book->save();

        $author = new BooksAuthor();
        $author->book_id =$book->id;
        $author->author_id = $author_id;
        $author_result = $author->save();

        $category = new BooksCategory();
        $category->book_id =$book->id;
        $category->category_id =$category_id;
        $category_result = $category->save();
		
		
        return redirect()->back()->with('add_status', [$book_result, $author_result, $category_result]);
    
    }

    // Create new Author
    public function create_author(){
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

    	return view('admin.create_author')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function store_author(AuthorRequest $request) {
        $name = $request['name'];
		$author = new Author();
        $author->name = $name;
        $result = $author->save();
		return redirect()->back()->with('add_status', $result);
    }
    // Create new Publisher
    public function create_publisher(){
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
    	return view('admin.create_publisher')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function store_publisher(PublisherRequest $request) {
        $name = $request['name'];
		$publisher = new Publisher();
        $publisher->name = $name;
        $result = $publisher->save();
		return redirect()->back()->with('add_status', $result);
    }
    // Create new Category
    public function create_category(){
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

    	return view('admin.create_category')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function store_category(CategoryRequest $request) {
        $name = $request['name'];
		$category = new Category();
        $category->category = $name;
        $result = $category->save();
		return redirect()->back()->with('add_status', $result);
    }

    public function edit($id){
        $book = Book::where('id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->first(); // Model
        
        $img_link = Storage::url($book->image);
    	$book->image = $img_link;

        $books_categories = BooksCategory::select('id', 'book_id', 'category_id')->get();
        $books_publishers = Publisher::select('id', 'name')->get();
        $books_authors = BooksAuthor::select('id','book_id', 'author_id')->get();

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('admin.edit')->with('book', $book)->with('books_categories', $books_categories)->with('books_publishers', $books_publishers)->with('books_authors', $books_authors)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function update(BookRequest $request, $id){
        if (!empty($request['image'])){
            $image = $request->file('image');
            $path = 'uploads/images/';
            $name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        }

        $title = $request['title'];
        $image = $request['image'];
        $description = $request['description'];
		$published_year = $request['published_year'];
		$published_number = $request['published_number'];
		$publisher_id = $request['publisher_id'];
		$author_id = $request['author_id'];
        $category_id = $request['category_id'];

        $book = Book::where('id',$id)->first();// Model

        $book->title = $title;
        if (!empty($image)){
            $book->image = $path.$name;
        }
		$book->description = $description;
		$book->published_year = $published_year;
		$book->published_number = $published_number;
		$book->publisher_id = $publisher_id;
		$book_result = $book->save();

        $author = BooksAuthor::where('book_id', $book->id)->first();
        if ($request['author_id'] != $author->author_id){
            $author->author_id = $author_id;
        }
        
        $author_result = $author->save();

        $category = BooksCategory::where('book_id', $book->id)->first();
        if ($request['category_id'] != $category->category_id){
            $category->category_id =$category_id;
        }
        $category_result = $category->save();
		
		return redirect()->back()->with('edit_status', [$book_result, $author_result, $category_result]);
    }

    public function destroy($id){
        Book::where('id',$id)->delete(); // with Model
        return redirect()->back();
    }

    public function restore($id)
    {
        $result = Book::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back();
    }
}
