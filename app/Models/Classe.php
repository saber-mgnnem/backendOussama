<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable=[
        "nom",
        "levels_id",
];
public function level(){
    return $this->belongsTo(level::class ,'levels_id','id');
}
}
