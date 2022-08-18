<div id="watcher-{{$watcher->id}}" class="w-full md:w-1/2 xl:w-1/3 p-6">
    <div class="bg-white border-transparent rounded-lg shadow-xl">
        <div
            class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
            <form action="{{route('watchers.destroy', $watcher->id)}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="DELETE">
                <button style="color:red;font-weight: bold;float:right;" type="submit">X</button>
            </form>
            <h2 class="font-bold uppercase text-gray-600">{{$watcher->symbol}}</h2>

        </div>
        <div class="p-5">
            <div id="watcher-header-percentage-{{$watcher->id}}" class="text-center small" style="line-height:0;">
                {!! displayPriceChangeInHistoryCell($watcher->oldPriceChangeData()) !!}
            </div>
            <div id="watcher-price-{{$watcher->id}}"
                 class="price-ticker text-center {{mainPriceChangeColor($watcher)}}">
                {{customPriceFormat($watcher->price)}}
            </div>
            <hr style="margin: 10px 0">
            <table id="watcher-history-{{$watcher->id}}" class="table-fixed w-full">
                @foreach($watcher->old_prices as $i => $oldPrice)
                    @include('partials._watcher_history_row')
                @endforeach
            </table>

            {{-- <ul>
                 @foreach($watcher->old_prices as $oldPrice)
                     <li><small>+{{$watcher->price_updated - $oldPrice['time']}}s</small>
                         <strong style="margin-left:1rem;">{{$oldPrice['price']}}</strong></li>
                 @endforeach
             </ul>--}}
            {{--  <span class="price-ticker" id="watcher-price-{{$watcher->id}}">{{$watcher->price}}</span>--}}
        </div>
    </div>
</div>
