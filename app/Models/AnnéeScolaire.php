<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnéeScolaire extends Model
{
    use HasFactory;
    protected $table ='année_scolaires';

    protected $fillable=[
        "Année_scolaire",
        "années_en_cours",
        "active",

];
}
