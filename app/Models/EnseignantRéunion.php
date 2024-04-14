<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EnseignantRéunion extends Model
{
    use HasFactory, Notifiable;
    protected $fillable=[
        "locale",
        "date",
        "sujet",
        "level_id",
        "phone",
        "annee_scolaire_id",
];
    public function level(){
        return $this->belongsTo(level::class ,'level_id','id');
    }
    
    /**
     * Route notifications for the Vonage channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForVonage($notification)
    {
        return $this->phone;
    }
}
