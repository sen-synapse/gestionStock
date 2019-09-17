<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    //
    protected $fillable = ['user', 'operation', 'libelle', 'created_at', 'updated_at'];
}
