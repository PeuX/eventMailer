<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\DatePending;
use App\Models\MailDuJour;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class FormSelected extends Component
{
    use WithFileUploads;

    public $commentaire;

    public $photo;

    public $date;

    public $eventId;

    protected $listeners  = ['dateSelected'];

    protected $rules = [
        'photo' => 'required|image',
    ];

    protected $messages = [
        'photo.required' => 'la photo est obligatoire 😅',
        'photo.max' => 'la photo est trop lourde!!! 😱',
    ];

    public function mount($eventId)
    {
        $this->eventId = $eventId;
    }
    
    public function dateSelected (String $dateJour){
        $datePending = new DatePending;
        $datePending->jour = $dateJour;
        $datePending->timestamp = time();
        $datePending->event_id = $this->eventId;
        $datePending->save();

        $this->date = $datePending;
    }

    public function render()
    {
        return view('livewire.form-selected');
    }

    public function updatedPhoto()
    {
        $this->validate();
    }

    public function save()
    {   
        $this->validate();
        $filename = $this->photo->store('photos');
        $img = Image::make(Storage::path($filename));
        $img->resize(1024, 1024, function ($const) {
            $const->aspectRatio();
        })->save(Storage::path($filename));
        $mailDuJour = new MailDuJour;
        $mailDuJour->event_id = $this->eventId;
        $mailDuJour->jour = $this->date->jour;
        $mailDuJour->texte = $this->commentaire;
        $mailDuJour->photo = $filename;
        $mailDuJour->save();
        $this->date->delete();
        Log::info($mailDuJour);
        $this->emit('formeSubmited', true);
    }
}
