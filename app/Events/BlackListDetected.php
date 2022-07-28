<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\BlackList;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Models\Notification;

class BlackListDetected implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public $listerId;
    public $newNotifications;
    public $newNotificationsCount;
    
    public function __construct($blackListId)
    {
        // $this->listerId = $listerId;
        $listerInfo = BlackList::find($blackListId);
        $insertToNotif = Notification::create([
            'type' =>           'blacklisted-registration',
            'black_list_id' =>   $blackListId,
            'description' =>    'There was an attempt from a blacklisted player to create a new account.'
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
