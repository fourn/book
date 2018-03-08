<?php

namespace App\Observers;

use App\Models\Book;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BookObserver
{
    public function saving(Book $book){
        $book->description = clean($book->description, 'user_book_description');


    }

    public function creating(Book $book)
    {
        //
    }

    public function updating(Book $book)
    {
        //
    }
}