<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPayed extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;
    public $message;
    /**
     * Create a new notification instance.
     * 已售出请确认
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
        $this->message = config('notify_order_payed');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', SmsChannel::class];
    }

    public function toSms($notifiable){
        return $this->message;
    }

    public function toDatabase($notifiable){
        $depot = $this->order->school->depot;
        return [
            'order_name'=>$this->order->name,
            'order_sn'=>$this->order->sn,
            'order_link'=>$this->order->sellerLink(),
            'depot'=>$depot,
            'message'=>$this->message,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
