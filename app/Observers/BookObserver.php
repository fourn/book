<?php

namespace App\Observers;

use App\Models\Book;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BookObserver
{
    public function creating(Book $book)
    {
        //
    }

    public function updating(Book $book)
    {
        //
    }
}