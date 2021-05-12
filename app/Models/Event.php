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
}
