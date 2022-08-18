<?php

use Carbon\Carbon;

function customPriceFormat($price)
{
    $decimals = strlen(substr(strrchr($price, "."), 1));
    return number_format($price, $decimals, '.', ' ');
}

function getColorByPriceChangeMovement($priceChangeData)
{
    if (!$priceChangeData) {
        return '';
    }
    if ($priceChangeData['movement'] == 'DOWN') {
        return 'red';
    }
    return 'green';
}

function mainPriceChangeColor($watcher)
{
    if (isset($watcher->old_prices[0])) {
        if ($watcher->old_prices[0]['price'] > $watcher->price) {
            return 'red';
        }
        return 'green';
    }
    return '';
}

function timestampToDateString($timestamp, $format = 'H:i:s')
{
    return Carbon::parse($timestamp)->format($format);
}

function displayPriceChangeInHistoryCell($priceChangeData)
{
    if (!$priceChangeData) {
        return '';
    }

    $color = getColorByValue($priceChangeData['percentage']);
    $cellInnerHtml = '<span class="' . $color . '">';
    $percentage = ($priceChangeData['percentage'] > 0 ? '+' : '') . $priceChangeData['percentage'];
    $cellInnerHtml .= $percentage . '%';
    $cellInnerHtml .= '</span>';

    return $cellInnerHtml;
}

function getColorByValue($value)
{
    if($value >= 0) {
        return 'green';
    }
    return 'red';
}

