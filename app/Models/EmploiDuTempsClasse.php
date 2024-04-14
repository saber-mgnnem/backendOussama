<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTempsClasse extends Model
{
    use HasFactory;
    protected $fillable=[
        "file",
        "description",
        "classe_id",
        "annee_scolaire_id",
];
    public function classe(){
        return $this->belongsTo(Classe::class ,'classe_id','id');
    }
    
    

}
