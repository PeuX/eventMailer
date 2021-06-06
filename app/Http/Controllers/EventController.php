<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Event;

class EventController extends Controller
{
    

    public function showevent($uniq_id){
        $event = Event::where('id_unique',$uniq_id)->findOrFail(1);
    
        return view('event', [
            'title' => $event->nom,
            'commentaire' => $event->commentaire,
            //'user' => User::findOrFail($id)
            'minDate' => $event->date_debut,
            'maxDate' => $event->date_fin,
            'unavailableDate' => $event->unavailableDate(),
            'event_id' => $event->id,
        ]);
    }
}
