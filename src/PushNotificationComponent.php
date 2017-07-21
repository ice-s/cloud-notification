<?php

namespace ices\CloudMessage;

class PushNotificationComponent
{
    private $listOs;

    public function __construct($listOs = array())
    {
        $this->listOs = $listOs;
    }

    public function push()
    {
        if (is_array($this->listOs)) {
            foreach ($this->listOs as $os) {
                if ($os instanceof NotificationStrategy) {
                    $os->push();
                } else {
                    echo "type of Object is not Notification Class";
                }
            }
        } else {
            $os = $this->listOs;
            if ($os instanceof NotificationStrategy) {
                $os->push();
            } else {
                echo "type of Object is not Notification Class";
            }
        }

    }
}