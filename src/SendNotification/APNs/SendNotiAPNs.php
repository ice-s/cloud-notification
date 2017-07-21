<?php

namespace ices\CloudMessage\SendNotification\APNs;

use ices\CloudMessage\SendNotification\NotiInterface\SendNoti;

use ices\CloudMessage\Message\MessageNotification;

class SendNotiAPNs implements SendNoti
{
    private $token;

    private $message;

    function __construct($token, MessageNotification $message)
    {
        $this->token = $token;
        $this->message = $message;
    }

    public function send()
    {
        $deviceToken = $this->token;
        try {
            $ctx = stream_context_create();
            stream_context_set_option($ctx, 'ssl', 'local_cert', APPPATH . "config/push_production.pem");
            stream_context_set_option($ctx, 'ssl', 'passphrase', "12345");
            $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err,
                $errstr, 30, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
            $body['aps'] = $this->message->renderAPNs();
            $payload = json_encode($body);
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            $result = fwrite($fp, $msg, strlen($msg));
            fclose($fp);
            $res = array(
                'status' => $result,
                'data' => $body['aps'],
            );
            echo json_encode($res);
        } catch (Exception $e) {

        }
    }
}