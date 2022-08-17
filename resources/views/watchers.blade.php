@extends('layouts.app')
@section('header')
    {{--  <header class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
              <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                  {{ __('Dashboard') }}
              </h2>
          </div>
      </header>--}}
@stop
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('watchers.store')}}" method="POST" class="w-full max-w-sm">
                        {{csrf_field()}}
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <input
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="symbol"
                                value="{{old('symbol')}}"
                                type="text"
                                placeholder="BTCUSDT"
                                aria-label="Symbol"
                            >

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                type="submit">
                                Add
                            </button>
                        </div>
                        @if($errors->first('symbol'))

                            <p style="color:red;">{{$errors->first('symbol')}}</p>

                        @endif

                    </form>
                    <div>
                        <ul id="messages">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-row flex-wrap flex-grow mt-2">
                    @foreach($watchers as $watcher)
                        @include('partials._watcher_box', ['watcher' => $watcher])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
@section('extra-scripts')
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('af2a035f587396777188', {
            cluster: 'eu',
            authEndpoint: "/broadcasting/auth",

        });

        var channel = pusher.subscribe('private-watchers.{{auth()->id()}}');
        channel.bind('price-changed' +
            '', function (data) {
            alert(JSON.stringify(data));
        });
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
        });
    </script>
@stop
