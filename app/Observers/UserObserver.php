<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function saving(User $user)
    {
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
        }
    }

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