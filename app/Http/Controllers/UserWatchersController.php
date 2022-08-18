<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use App\Services\UserWatcherService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Interfaces\WatcherRepositoryInterface;

class UserWatchersController extends Controller
{

    /*  private $user;
      public function __construct()
      {
          $this->middleware('auth');
          $this->user = auth()->user();
          dd($this->user);
      }*/

    public function index()
    {
        $user = $this->getUser();
        $userWatchers = (new UserWatcherService($user))->getAll();
        $allWatchers = Watcher::pluck('symbol', 'id')->toArray();
        $selectableWatchers = array_diff($allWatchers, $userWatchers->pluck('symbol', 'id')->toArray());


        return view('watchers')
            ->with(compact('userWatchers', 'selectableWatchers'));

    }

    public function store(Request $request)
    {
        $user = $this->getUser();

        $this->validate($request, [
            'watcher_id' => ['required', 'exists:watchers,id']
        ]);

        (new UserWatcherService($user))->addById($request->input('watcher_id'));

        return redirect()->route('watchers.index');

    }

    public function destroy($watcherId)
    {
        $user = $this->getUser();
        (new UserWatcherService($user))->removeById($watcherId);

        return redirect()->route('watchers.index');
    }
}
