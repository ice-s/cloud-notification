<?php

namespace ices\CloudMessage\Message;

class MessageNotification
{
    private $noti_id = 0;
    private $title = "default";
    private $body = "default";
    private $badge = 1;
    private $type_of_noti = "DEFAULT";
    private $screen = "HOME";
    private $image_preview = "";
    private $created_time = "";

    function __construct($noti_id = 0, $title = "", $body = "", $badge = 0, $type_of_noti = "",
                         $screen = "", $image_preview = "https://google.com", $created_time = ""){
        $this->noti_id = $noti_id;
        $this->title = $title;
        $this->body = $body;
        $this->badge = $badge;
        $this->type_of_noti = $type_of_noti;
        $this->screen = $screen;
        $this->image_preview = $image_preview;
        $this->created_time = $created_time;
    }

    function renderAPNs()
    {
        $aps = array(
            'alert' => array(
                'noti_id' => $this->noti_id,
                "title" => $this->title,
                "body" => $this->body,
                'type_of_noti' => $this->type_of_noti,
                'screen' => $this->screen,
                'image_preview' => $this->image_preview,
                'created_time' => $this->created_time,
            ),
            'sound' => 'default',
            "badge" => $this->badge
        );
        return $aps;
    }

    function renderFCM()
    {
        $msg = array(
            'noti_id' => $this->noti_id,
            "title" => $this->title,
            'message_body' => $this->body,
            'type_of_noti' => $this->type_of_noti,
            'screen' => $this->screen,
            'image_preview' => $this->image_preview,
            'badge' => $this->badge,
            'created_time' => $this->created_time,
        );
        return $msg;
    }

    function renderGCM()
    {
        $msg = array(
            'noti_id' => $this->noti_id,
            "title" => $this->title,
            'message_body' => $this->body,
            'type_of_noti' => $this->type_of_noti,
            'screen' => $this->screen,
            'image_preview' => $this->image_preview,
            'badge' => $this->badge,
            'created_time' => $this->created_time,
        );
        return $msg;
    }
}