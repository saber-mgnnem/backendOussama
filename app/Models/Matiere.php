<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $table="matieres";
    protected $fillable=[
	    	"enseignant_id",
        "Name",
        "description",
        "classe_id",

];

public function classe(){
  return $this->belongsTo(Classe::class ,'classe_id','id');
}
public function enseignant(){
  return $this->belongsTo(User::class ,'enseignant_id','id');
}
	
}
