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

    /**
     * 能否操作上下架
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function toggleShow(User $user, Book $book){
        $status = array_pluck(config('custom.book.status'), 'canShow', 'id');
        return $user->isAuthOf($book) && $status[$book->status];
    }

    /**
     * 能否进行购买
     * @param User $user
     * @param Book $book
     * @return bool
     */
    public function buy(User $user, Book $book){
        return !$user->isAuthOf($book) && $book->canBuy();
    }
}
