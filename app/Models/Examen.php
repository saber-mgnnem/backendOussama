<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable=[
        "nom",
        "matiere_id",
        "classe_id",
        "description",
        "enseignant_id",
        "annee_scolaire_id",

];
    public function enseignant(){
    return $this->belongsTo(User::class ,'enseignant_id','id');
}
public function matiere(){
    return $this->belongsTo(Matiere::class ,'matiere_id','id');
} public function classe(){
    return $this->belongsTo(Classe::class ,'classe_id','id');
}
}









