<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatePending extends Model
{
    use HasFactory;

    /**
     * Get the event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function purgeDate(){
        $this->where('timestamp', '<', time()-3600)->delete();
    }
}
