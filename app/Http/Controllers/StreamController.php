<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StreamController extends Controller
{
    /**
     * The stream source.
     *
     * @return StreamedResponse
     */
    public function __invoke(): StreamedResponse
    {
        return response()->stream(function () {
            while (true) {
                if (connection_aborted()) {
                    break;
                }
                /*if ($messages = Message::where('created_at', '>=', Carbon::now()->subSeconds(5))->get()) {
                    echo "event: ping\n", "data: {$messages}", "\n\n";
                }*/
                ob_flush();
                flush();
                sleep(5);
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
        ]);
    }
}
