<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Notification;

class DuplicateDetected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $newNotifications;
    public $newNotificationsCount;
    public function __construct($detectedUserIdDuplicate)
    {
        $insertToNotif = Notification::create([
            'type' =>           'duplicate-registration',
            'black_list_id' =>   $detectedUserIdDuplicate,
            'description' =>    'Same name registration detected.'
        ]);
        $this->newNotifications = Notification::select('id','type')->where('is_read',0)->get();
        $this->newNotificationsCount = $this->newNotifications->count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['notification'];
    }
}
