<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;
use PhpSms;
class SmsChannel
{
    /**
     * 发送给定通知
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $content = $notification->toSms($notifiable);

        // 将通知发送给 $notifiable 实例
        $mobile = $notifiable->routeNotificationFor('sms');
        PhpSms::make()->to($mobile)->content($content)->send();
    }
}