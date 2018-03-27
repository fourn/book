<?php

namespace App\Observers;

use App\Jobs\EditBook;
use App\Models\Book;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class BookObserver
{
    public function saving(Book $book){
        $book->description = clean($book->description, 'user_book_description');
    }

    public function saved(Book $book){
        //书本被修改或者购买后产生的变动
        if($book->wasChanged('status')){
            if($book->status != 2){
                dispatch(new EditBook($book));
            }
        }
    }

    public function deleted(Book $book){
        //书本删除后
        dispatch(new EditBook($book));
    }
}