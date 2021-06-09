<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;
use App\Models\MailDuJour;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class EventMailDuJour extends Mailable
{
    use Queueable, SerializesModels;

    public $texte='';
    public $photo;
    public $nbdays=0;
    protected $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
        $mailDuJour = $event->mailsDuJour->where('jour',now()->toDateString())->where('fait',0)->first();
        if(!empty($mailDuJour)){
            $this->texte = $mailDuJour->texte;
            $this->photo = Storage::path($mailDuJour->photo);
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $dt = Carbon::parse($this->event->date_fin);
        $diff = $dt->diffInDays(now()->startOfDay());
        if($diff>0) $subject = sprintf('Plus que %d Jours avant le Jour J',$diff);
        else $subject = 'C\'est le grand JOUR!!!';
        return $this->subject($subject)->view('email.mailDuJour');
    }
}
