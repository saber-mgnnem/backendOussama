<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $table ='Modules';

    protected $fillable=[
        "matiere_id",
        "name",
        "Small_description",

];
public function matiere(){
    return $this->belongsTo(Matiere::class ,'matiere_id','id');
}
}
