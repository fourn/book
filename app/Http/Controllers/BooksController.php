<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use Auth;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'list']]);
    }

    public function list(){
        $categories = Category::all();
        return view('books.list', compact('categories'));
    }

	public function index(Request $request)
	{
	    $category_id = $request->category_id;
		$books = Book::ofSchool()
            ->when($category_id, function ($query) use ($category_id){
		    return $query->where('category_id', $category_id);
        })->orderBy(
            $request->input('orderBy', 'updated_at'),
            $request->input('orderType', 'desc')
        )->paginate(6);
		return view('books.index', compact('books'));
	}

	public function my(Request $request){
        $user = Auth::user();
        $mybooks = $user->books()
            ->when($request->status, function ($query) use ($request){
                return $query->where('status', $request->status);
            })
            ->orderBy('created_at', 'desc')->get();
        $statuses = config('custom.book.status');
        return view('books.my', compact('statuses', 'mybooks'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

	public function create(Book $book)
	{
	    $categories = Category::all();
		return view('books.create_and_edit', compact('book', 'categories'));
	}

	public function store(BookRequest $request)
	{
		$book = Book::create($request->all());
		return redirect()->route('books.show', $book->id)->with('message', 'Created successfully.');
	}

	public function edit(Book $book)
	{
        $this->authorize('update', $book);
		return view('books.create_and_edit', compact('book'));
	}

	public function update(BookRequest $request, Book $book)
	{
		$this->authorize('update', $book);
		$book->update($request->all());

		return redirect()->route('books.show', $book->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Book $book)
	{
		$this->authorize('destroy', $book);
		$book->delete();

		return redirect()->route('books.index')->with('message', 'Deleted successfully.');
	}
}