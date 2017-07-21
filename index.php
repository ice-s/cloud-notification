<?php

include_once('vendor/autoload.php');
use ices\CloudMessage\AndroidNotificationStrategy;
use ices\CloudMessage\Message\MessageNotification;
use ices\CloudMessage\AndroidNotificationStrategy as AndroidNotification;
use ices\CloudMessage\PushNotificationComponent as PushNoti;

$reg_id = "red_id";
$token = "token_ios";
$message = new MessageNotification(
    1002, // notification id - get after save notification database
    'title x', // Title Notifiation - get from config in database
    'body x', // Body notification - get from config in database
    1,          // Badge - get unread notification with user
    'type X', // type of notification - get from database - redirect to screen
    'screen', // screen - get from database - redirect to screen
    'https://facebook.com/nguyentruongson93', // image preview notification
    time()  // created time notification
);

$gcm = new AndroidNotification($reg_id, "FCM", $message);

$push = new PushNoti($gcm);
$push->push();