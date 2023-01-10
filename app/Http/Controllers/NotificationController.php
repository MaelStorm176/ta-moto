<?php
namespace App\Http\Controllers;
use App\Models\Notification;
use App\Models\NotificationRead;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NotificationController extends Controller
{
    public function stream(): void
    {
        $response = new StreamedResponse();
        $response->setCallback(function () {
            $notifications = Notification::query()
                ->where('expired_at', '>', now())
                ->whereDoesntHave('readers', static function ($query) {
                    $query->where('user_id', auth()->id());
                })
                ->orderBy('id', 'desc')
                ->get();
            foreach ($notifications as $notification) {
                echo 'event: notification' . PHP_EOL;
                echo 'data: ' . json_encode($notification) . PHP_EOL;
                echo PHP_EOL;
            }
            ob_flush();
            flush();
            sleep(1);
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->send();
    }

    public function read(Notification $notification): NotificationRead
    {
        return NotificationRead::query()->create([
            'notification_id' => $notification->id,
            'user_id' => auth()->id(),
            'read_at' => now(),
        ]);
    }
}
