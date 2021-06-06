<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Event;
use App\Mail\EventMailDuJour;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {event}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envoi le mail du jour à un utilisateur';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $event = Event::where('id_unique',$this->argument('event'))->findOrFail(1);
        if($event!== false){
            $mailDuJour = $event->mailsDuJour->where('jour',now()->toDateString())->where('fait',0)->first();
            if(!empty($mailDuJour)){
                Mail::to($event->destinataire)->send(new EventMailDuJour($event));
                $mailDuJour->fait = 1;
                $mailDuJour->save();
            }
        }
    }
}
