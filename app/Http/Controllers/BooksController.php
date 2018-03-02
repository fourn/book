<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$books = Book::paginate();
		return view('books.index', compact('books'));
	}

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

	public function create(Book $book)
	{
		return view('books.create_and_edit', compact('book'));
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