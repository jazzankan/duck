<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Project;
use App\Todo;
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
    public $createdtodo; //Hämta senaste i tabellen
    public $changedtodo;  //Hämta senast ändrade
    public $myname;
    public $newtodo;
    public $fixedtodo;  //Redigerad arbetsuppgift

    public function __construct($new = false, $fixed = false)
    {
        $this->newtodo = $new;
        $this->fixedtodo = $fixed;
        $this->project = Project::latest('updated_at')->first();
        $this->createdtodo = Todo::latest('created_at')->first();
        $this->changedtodo = Todo::latest('updated_at')->first();
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
     if($this->newtodo == true && $this->fixedtodo == false){
            return (new MailMessage)
                ->from('anders@webbsallad.se', 'Ankhemmet')
                ->subject('Ny arbetsuppgift i projektet "' .$this->project->title .'"!')
                ->line( 'Ny arbetsuppgift: "' . $this->createdtodo->title . '"')
                ->line('Du kanske ska ta en titt?')
                ->action('Till projektet', url('https://ank.webbsallad.se/projects/'.$this->project->id));
        }
     elseif($this->newtodo == false && $this->fixedtodo == true){
         return (new MailMessage)
             ->from('anders@webbsallad.se', 'Ankhemmet')
             ->subject('Arbetsuppgiften ' . $this->changedtodo->title . ' har ändrats.')
             ->line( 'Arbetsuppgiften "' . $this->changedtodo->title. '" tillhörande projektet "' . $this->project->title . '" har redigerats')
             ->line('Kanske har något blivit gjort?')
             ->action('Till projektet', url('https://ank.webbsallad.se/projects/'.$this->project->id));
     }

     else {
         return (new MailMessage)
             ->from('anders@webbsallad.se', 'Ankhemmet')
             ->subject('Projektet "'.$this->project->title.'"  har ändrats av '.$this->myname)
             ->line('Du kanske ska ta en titt?')
             ->action('Till projektet', url('https://ank.webbsallad.se/projects/'.$this->project->id));
        }
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
