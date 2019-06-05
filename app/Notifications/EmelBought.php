<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmelBought extends Notification
{
    use Queueable;

    protected $penjual;
    protected $pembeli;
    protected $food;
    protected $jumlah;
    protected $harga;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($penjual, $pembeli, $food, $jumlah, $harga)
    {
        $this->penjual = $penjual;
        $this->pembeli = $pembeli;
        $this->food = $food;
        $this->jumlah = $jumlah;
        $this->harga = $harga;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->greeting("Hello {$this->penjual}")
                    ->line("{$this->pembeli} has bought {$this->jumlah} {$this->food} with a total of RM {$this->harga}")
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
