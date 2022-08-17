<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Watcher;
use Illuminate\Auth\Access\HandlesAuthorization;

class WatcherPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Watcher $watcher)
    {
        return $user->id === $watcher->user_id;
    }

    public function destroy(User $user, Watcher $watcher)
    {
      return $user->id === $watcher->user_id;
    }
}
