<?php

namespace ices\CloudMessage;

use ices\CloudMessage\SendNotification\APNs\SendNotiAPNs as SendNotiAPNs;
use ices\CloudMessage\Message\MessageNotification;

class IosNotificationStrategy implements NotificationStrategy
{
    private $token;

    private $apns;
    private $message;

    function __construct($token, MessageNotification $message)
    {
        $this->message = $message;
        $this->apns = new SendNotiAPNs($token, $this->message);
    }

    public function push()
    {
        $this->apns->send();
    }
}