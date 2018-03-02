<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Book;

class BookPolicy extends Policy
{
    public function update(User $user, Book $book)
    {
        // return $book->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Book $book)
    {
        return true;
    }
}
