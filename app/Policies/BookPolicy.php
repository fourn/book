<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy extends Policy
{
    public function update(User $user, Book $book)
    {
        $status = array_pluck(config('custom.book.status'), 'canEdit', 'id');
        return $user->isAuthOf($book) && $status[$book->status];
    }

    public function destroy(User $user, Book $book)
    {
        $status = array_pluck(config('custom.book.status'), 'canDelete', 'id');
        return $user->isAuthOf($book) && $status[$book->status];
    }

    public function toggleShow(User $user, Book $book){
        $status = array_pluck(config('custom.book.status'), 'canShow', 'id');
        return $user->isAuthOf($book) && $status[$book->status];
    }
}
