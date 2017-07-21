<?php

namespace ices\CloudMessage;

use ices\CloudMessage\NotificationStrategy;
use ices\CloudMessage\Message\MessageNotification;
use ices\CloudMessage\SendNotification\CloudMessage\SendNotiGCM;
use ices\CloudMessage\SendNotification\CloudMessage\SendNotiFCM;

class AndroidNotificationStrategy implements NotificationStrategy
{
    private $reg_id;

    private $cloud_msg;

    private $message;

    function __construct($reg_id, $sendType, MessageNotification $message)
    {
        if (is_array($reg_id)) {
            $this->reg_id = $reg_id;
        } else {
            $this->reg_id = array($reg_id);
        }

        $this->message = $message;

        switch ($sendType) {
            case "GCM":
                $this->cloud_msg = new SendNotiGCM($this->reg_id, $this->message);
                break;
            case "FCM":
                $this->cloud_msg = new SendNotiFCM($this->reg_id, $this->message);
                break;
            default:
                $this->cloud_msg = new SendNotiFCM($this->reg_id, $this->message);
                break;
        }


    }

    public function push()
    {
        $this->cloud_msg->send();
    }
}