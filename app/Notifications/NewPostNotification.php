<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Support\Facades\Storage;

class NewPostNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $user;
    protected $type;

    const POST_TYPE = [
        'like' => 'like',
        'comment' => 'comment',
        'reply_comment' => 'reply_comment',
    ];

    /**
     * Create a new notification instance.
     */
    public function __construct($post,$user,$type)
    {
        $this->post = $post;
        $this->user = $user;
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
        $src = asset('images/players/player.webp');
        $img = "<img src='".$src."' alt='Avatar' class='w-10 rounded-full'>";
        
        $file_name = 'players/' . auth()->user()->player->id . '/' . $this->user->player->img;

        if(Storage::disk('public')->exists($file_name))
        {
            $src = Storage::url($file_name);
            $img = "<img src='".$src."' alt='Avatar' class='w-10 rounded-full'>";
        }

        // Kiểm tra loại thông báo
        if($this->type == $this::POST_TYPE['like'])
        {
            $text = "<span><strong> ". $this->user->player->name . "</strong> đã thích bài viết của bạn</span>";
        }
        elseif($this->type == $this::POST_TYPE['comment'])
        {
            $text = "<span><strong> ". $this->user->player->name . "</strong> đã bình luận bài viết của bạn</span>";
        }
        elseif($this->type == $this::POST_TYPE['reply_comment'])
        {
            $text = "<span><strong> ". $this->user->player->name . "</strong> đã trả lời bình luận của bạn</span>";
        }
        
        return [
            'post_id' => $this->post->id,
            'link' => route('posts.show', $this->post->id),
            'message' => '
                <div class="flex items-center gap-2 mr-2">
                    '.$img.'
                    '.$text.'
                </div>
            '
        ];
    }

    // Gửi thông báo qua WebSocket (Broadcasting)
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'post_id' => $this->post->id,
            'message' => 'Có một thông báo về bài viết của bạn: ' . $this->post->id,
        ]);
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
