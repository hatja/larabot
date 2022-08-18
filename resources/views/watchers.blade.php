@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Add new watcher</h2>
                    <form action="{{route('watchers.store')}}" method="POST" class="w-full max-w-sm">
                        {{csrf_field()}}
                        <div class="flex items-center border-b border-teal-500 py-2">
                            <select placeholder="Select asset"
                                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="watcher_id"
                            >
                                <option readonly>Select market</option>
                                @foreach($selectableWatchers as $id => $symbol)
                                    <option value="{{$id}}">{{$symbol}}</option>
                                @endforeach
                            </select>

                            <button
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                type="submit">
                                Add +
                            </button>
                        </div>
                        @if($errors->first('watcher_id'))
                            <p style="color:red;">{{$errors->first('watcher_id')}}</p>
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
                    @foreach($userWatchers as $watcher)
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
            //authEndpoint: "/broadcasting/auth",
        });
        @foreach($userWatchers as $watcher)
        var channel = pusher.subscribe('watchers.{{$watcher->id}}');
        channel.bind('price-changed' +
            '', function (data) {
            let watcher = data.watcher;
            let price = customNumberFormat(parseFloat(watcher.price));

            $('#watcher-price-' + watcher.id).removeClass('red green').addClass(data.watcher.color).fadeOut(function () {
                $(this).text(price).fadeIn();
            });
            let mainPercentage = watcher.main_price_change_data.percentage
            $('#watcher-header-percentage-' + watcher.id)
                .removeClass('red green').addClass(mainPercentage >= 0 ? 'green' : 'red')
                .text((mainPercentage > 0 ? ('+' + mainPercentage) : mainPercentage) + '%')
            $('#watcher-history-' + watcher.id).prepend(data.watcher.table_row_html).fadeIn('slow');
            let limit = watcher.old_prices.length;
            $('#watcher-history-' + watcher.id + ' tr:gt(' + limit + ')').remove();
        });
        @endforeach
        var pusherAuth = new Pusher('af2a035f587396777188', {
            cluster: 'eu',
            authEndpoint: "/broadcasting/auth",
        });
        var channel = pusherAuth.subscribe('private-orders.{{auth()->id()}}');
        channel.bind('price-changed' +
            '', function (data) {
            alert(data);
        });

        function customNumberFormat(number) {
            return number.toLocaleString('en', {
                minimumFractionDigits: 1,
                maximumFractionDigits: 12
            }).replace(/,/g, " ");
        }

    </script>
@stop
