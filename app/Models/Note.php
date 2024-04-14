<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
     protected $fillable=[
        "Note",
        "description",
        "Examen_id",
        "eleve_id",
        "annee_scolaire_id",

];
    public function eleve(){
    return $this->belongsTo(User::class ,'eleve_id','id');
}
public function Examen(){
    return $this->belongsTo(Examen::class ,'Examen_id','id');
}
}
