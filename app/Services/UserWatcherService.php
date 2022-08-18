<?php
namespace App\Services;

use App\Models\User;

class UserWatcherService
{

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function getAll()
    {
        return $this->user->watchers;
    }

    public function getById($watcherId)
    {
        return $this->user->watchers()->findOrFail($watcherId);
    }

    public function addById($watcherId)
    {
        $this->user->watchers()->sync($watcherId, false);
    }

    public function removeById($watcherId)
    {
        $this->user->watchers()->detach($watcherId);
    }
}
