<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPasswordMail extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject('Şifre Sıfırlama')
            ->greeting('Şifre Sıfırlama İşlemi!')
            ->line('Bu e-postayı, hesabınızın şifresini sıfırlama isteği aldığımız için aldınız. Şifrenizi sıfırlamak istiyorsanız, aşağıdaki butona tıklayın:')
            ->action('Şifreyi sıfırla', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Bir şifre sıfırlama isteğinde bulunmadıysanız, Bu emaili dikkate almayınız.');
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
