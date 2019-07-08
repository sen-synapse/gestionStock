<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    //
    protected $fillable = ['codeCategorie', 'categorie', 'created_at', 'updated_at'];

    public function sousCategories()
    {
      return $this->hasMany('App\Models\SousCategories', 'idsoucat');
    }
}
