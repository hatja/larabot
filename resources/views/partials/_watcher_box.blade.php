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
            Price: <span id="watcher-price-{{$watcher->id}}"></span>
        </div>
    </div>
</div>
