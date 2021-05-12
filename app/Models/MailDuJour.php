<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailDuJour extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
