<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //如果之前选择过学校则关联学校
        if(session()->has('school_id')){
            $user->school_id = session('school_id');
        }
    }

    public function created(User $user){

    }

    public function updating(User $user)
    {
        //
    }
}