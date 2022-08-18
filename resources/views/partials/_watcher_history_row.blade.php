<tr class="hover:bg-blue-50">
    <td class="text-left">
        <small> {{--{{\Carbon\CarbonInterval::seconds($watcher->price_updated - $oldPrice['time'])->cascade()->forHumans()}}--}}
           {{timestampToDateString($oldPrice['time'])}} {{--{{$watcher->price_updated - $oldPrice['time']}}s--}}
        </small>
    </td>
    <td class="text-center"><strong class="{{getColorByPriceChangeMovement($watcher->oldPriceChangeData($i))}}" style="margin-left:1rem;">{{$oldPrice['price']}}</strong></td>
    <td class="text-right small">{!! displayPriceChangeInHistoryCell($watcher->oldPriceChangeData($i)) !!}</td>
</tr>
