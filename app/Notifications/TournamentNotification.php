<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TournamentNotification extends Notification
{
    use Queueable;

    protected $tournament;
    protected $type;

    const TOURNAMENT_TYPE = [
        'register' => 'register',
        'register_access' => 'register_access',
        'register_unsuccessful' => 'register_unsuccessful',
    ];

    /**
     * Create a new notification instance.
     */
    public function __construct($tournament,$type)
    {
        $this->tournament = $tournament;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail( $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

     // Lưu thông báo vào database
    public function toDatabase($notifiable)
    {
        if ($this->type == self::TOURNAMENT_TYPE['register']) {
            $text = '<span class="">Đăng ký giải đấu thành công</span>';
        } elseif ($this->type == self::TOURNAMENT_TYPE['register_access']) {
            $text = '<span class="">Đơn đăng ký của bạn đã được chấp nhận</span>';
        } elseif ($this->type == self::TOURNAMENT_TYPE['register_unsuccessful']) {
            $text = '<span class="">Đơn đăng ký của bạn không thành công</span>';
        }
        return [
            'tournament_id' => $this->tournament->id,
            'link' => route('ranking.tournament'),
            
            'message' => '
                <div class="flex items-center gap-2 mr-2">
                    '.$text.'
                </div>
            '
        ];
    }

    // Gửi thông báo qua WebSocket (Broadcasting)
    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     'post_id' => $this->post->id,
        //     'message' => 'Có một thông báo về bài viết của bạn: ' . $this->post->id,
        // ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable): array
    {
        return [
            //
        ];
    }
}
