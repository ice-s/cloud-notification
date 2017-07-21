<?php
namespace ices\CloudMessage\SendNotification\CloudMessage;

use ices\CloudMessage\SendNotification\NotiInterface\SendNoti as Sendnoti;

use ices\CloudMessage\Message\MessageNotification;

define('API_ACCESS_KEY_FCM', 'AIzaSyAHLmehfalcwwp-_RE4U4Npb33cO4pVgEA');

class SendNotiFCM implements SendNoti
{
    private $reg_id;
    private $message;

    function __construct($reg_id, MessageNotification $message)
    {
        $this->reg_id = $reg_id;
        $this->message = $message;
    }

    public function send()
    {
        try {
            $msg = $this->message->renderFCM();

            $fields = array
            (
                'data' => $msg,
                "registration_ids" => $this->reg_id,
            );

            $headers = array
            (
                'Authorization: key=' . API_ACCESS_KEY_FCM,
                'Content-Type: application/json'
            );

            #Send Reponse To FireBase Server
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);

            $res = json_decode($result);
            $res->type = "FMC";
            $res->data = $msg;
            echo json_encode($res);
        } catch (Exception $x) {

        }
    }
}