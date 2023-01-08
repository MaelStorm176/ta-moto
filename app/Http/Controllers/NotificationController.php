<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NotificationController extends Controller
{
    public function stream(): StreamedResponse
    {
        return response()->stream(function () {
            while (true) {
                if (connection_aborted() || connection_status() !== CONNECTION_NORMAL) {
                    break;
                }
                $data = Notification::orderBy('created_at', 'desc')->first();
                echo "event: notification\n";
                echo "data: {$data->toJson()}\n\n";

                ob_flush();
                flush();

                usleep(500000);
            }
        }, 200, [
            'Content-Type' => 'text/event-stream',
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}
