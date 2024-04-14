<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    use HasFactory;
    protected $fillable=[
        "student_id",
        "classe_id",
        "annee_scolaire_id",
];
    public function student(){
    return $this->belongsTo(User::class ,'student_id','id');
}


public function classe(){
    return $this->belongsTo(Classe::class ,'classe_id','id');
}
}
