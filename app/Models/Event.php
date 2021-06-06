<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the MailDuJour for the event
     */
    public function mailsDuJour()
    {
        return $this->hasMany(MailDuJour::class);
    }
 
    /**
     * Get the datePending for the event
     */
    public function datePending()
    {
        return $this->hasMany(DatePending::class);
    }

    /**
     * renvoi la date des jour déja pris
     */
    public function unavailableDate()
    {
        $dateJoursPris = array();
        $datesPending = $this->datePending;
        $first = true;
        foreach($datesPending as $dp){
            if($first){
                $first = false;
                $dp->purgeDate();
            }
            $dateJoursPris[] = $dp->jour;
        }
        $MailsDuJour = $this->mailsDuJour;
        foreach($MailsDuJour as $mj){
            $dateJoursPris[] = $mj->jour;
        }
        sort($dateJoursPris);
        return $dateJoursPris;
    }
}
