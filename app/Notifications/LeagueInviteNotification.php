<?php

namespace App\Notifications;

use App\Predictor\League;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LeagueInviteNotification extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * The league object
     *
     * @var League
     */
    public $league;
    /**
     * New user password
     */
    public $password;

    /**
     * Create a new notification instance.
     *
     * @param League $league
     * @param $password
     */
    public function __construct(League $league, $password)
    {
        $this->league   = $league;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/leagues/join/' . $this->league->code);
        return (new MailMessage)
            ->subject('Te han invitado a una liga en Predictor')
            ->markdown('notifications.leagues.invite', [
                'url'      => $url,
                'league'   => $this->league,
                'password' => $this->password,
                'email'    => $notifiable->email
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
