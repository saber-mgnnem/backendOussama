<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTempsEnseignant extends Model
{
    use HasFactory;
    protected $fillable=[
        "file",
        "description",
        "id_enseignant",
        "inscription_id",
        "annee_scolaire_id",
];
    public function enseignant(){
        return $this->belongsTo(User::class ,'id_enseignant','id');
    }
    
    
    public function inscription(){
        return $this->belongsTo(InscriptionEnseignant::class ,'inscription_id','id');
    }
}
