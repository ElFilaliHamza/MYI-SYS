<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Soft delete the given user.
     */
    public function delete(User $user): void
    {
        $user->update(['deleted' => 1]);
    }
}