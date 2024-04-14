<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InscriptionEnseignant extends Model
{
    use HasFactory;
    protected $fillable=[
        "enseignant_id",
        "classe_id",
        "annee_scolaire_id",
];
    public function enseignant(){
    return $this->belongsTo(User::class ,'enseignant_id','id');
}


public function classe(){
    return $this->belongsTo(Classe::class ,'classe_id','id');
}
}
