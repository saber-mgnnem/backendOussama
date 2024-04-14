<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    use HasFactory;
    protected $fillable=[
        "exercice",
        "description",
        "file",
        "Matiere_id",
        "Module_id",
        "annee_scolaire_id",

];
    public function matiere(){
        return $this->belongsTo(Matiere::class ,'Matiere_id','id');
    }
    public function Module(){
        return $this->belongsTo(Module::class ,'Module_id','id');
    }
}
