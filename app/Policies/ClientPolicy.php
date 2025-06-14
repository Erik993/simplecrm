<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /*
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'head', 'manager']);
    }*/

    /**
     * Determine whether the user can view the model.
     */
    /*
    public function view(User $user, Client $client): bool
    {
        if (in_array($user->role, ['admin', 'head'])) {
            return true;
        }

        return $user->role === 'manager' && $client->user_id === $user->id;
    }*/

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['head', 'admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        if (in_array($user->role, ['admin', 'head'])) {
            return true;
        }

        //manager can edit only his own clients. client->user_id = user->ud
        return $user->role === 'manager' && $client->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $client): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Client $client): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Client $client): bool
    {
        return false;
    }
}
