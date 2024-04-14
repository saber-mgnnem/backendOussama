<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicCour extends Model
{
    use HasFactory;
    protected $fillable=[
        "name",
        "Niveau_id",
        "description",
        "Matiere",
        "Categorie",
        "file",
        "enseignant_id",


];
    public function enseignant(){
    return $this->belongsTo(User::class ,'enseignant_id','id');
}
}
