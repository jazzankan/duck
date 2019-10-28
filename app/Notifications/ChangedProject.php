<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Project;
use App\User;

class ChangedProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $project;
    public $myname;

    public function __construct()
    {
        $this->project = Project::latest('updated_at')->first();
        $this->myname = auth()->user()->name;

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
            ->from('anders@webbsallad.se', 'Ankhemmet')
            ->subject('Projektet "' .  $this->project->title . '"  har ändrats av ' . $this->myname)
            ->line('Du kanske ska ta en titt?')
            ->action('Till projektet', url('https://ank.webbsallad.se/projects/' . $this->project->id));

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
