<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Interfaces\WatcherRepositoryInterface;

class WatchersController extends Controller
{
    private WatcherRepositoryInterface $watcherRepository;

    public function __construct(WatcherRepositoryInterface $watcherRepository)
    {
        $this->watcherRepository = $watcherRepository;
    }

    public function index()
    {
        $user = $this->getUser();
        $watchers = $this->watcherRepository->getWatchersByUser($user);

        return view('watchers')
            ->with(compact('watchers'));

    }

    public function store(Request $request)
    {
        $user = $this->getUser();
        $this->validate($request, [
            'symbol' => ['required', 'string', 'min:2', 'max:8', 'uniqueWith:watchers,symbol,user_id,'.$user->id]
        ]);

        $this->watcherRepository->create($user, $request->input('symbol'));

        return redirect()->route('watchers.index');

    }

    public function update(Request $request, $watcherId)
    {
        //$user = $this->getUser();
        $this->watcherRepository->updateWatcher($watcherId, $request->only('order'));

        return redirect()->route('watchers.index');

    }



    public function destroy($watcherId)
    {
        $watcher = Watcher::findOrFail($watcherId);
        try {
            $this->authorize('destroy', $watcher);
        } catch (AuthorizationException $e) {
            dd($e);
        }
        $this->watcherRepository->deleteWatcher($watcherId);

        return redirect()->route('watchers.index');
    }
}
