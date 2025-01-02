<?php

use Illuminate\Notifications\Notification;

class MeetingReservedNotification extends Notification
{
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'sender_id' => $this->details['sender_id'],      // The user who created the meeting
            'group_id' => $this->details['group_id'],        // Group ID if applicable
            'webinar_id' => $this->details['webinar_id'],    // Webinar ID if applicable
            'title' => $this->details['title'],              // Meeting title
            'message' => $this->details['message'],          // Custom notification message
            'sender' => $this->details['sender'],            // 'system' or 'admin'
            'type' => $this->details['type'],                // 'single' or other types
        ];
    }
}
