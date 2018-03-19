<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transfer;

class TransferPolicy extends Policy
{
    public function update(User $user, Transfer $transfer)
    {
        // return $transfer->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Transfer $transfer)
    {
        return true;
    }
}
