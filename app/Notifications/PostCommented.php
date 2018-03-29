<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use risul\LaravelLikeComment\Models\Comment;

class PostCommented extends Notification
{

    protected $comment;
    protected $data;

    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment, $data)
    {
        //
        $this->comment = $comment;
        $this->data = $data;
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
                    ->greeting(' ')
                    ->line('Новый комментарий пользователя ' . $this->data['commenter'] .  ' к статье "' . $this->data['title'] . '" :')
                    ->line(' …' . $this->data['body'] . '…')
                    ->action('Перейти на страницу статьи', url('/posts/' . $this->data['slug'] ))
                    ->salutation('С приветом, Я!');
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
