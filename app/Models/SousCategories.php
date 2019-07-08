<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousCategories extends Model
{
    //
    protected $fillable = ['codesouscat', 'souscategorie', 'idcategorie', 'unitearticle', 'dimension', 'created_at', 'updated_at'];

    public function article()
    {
      return $this->hasMany('App\Models\Article', 'idsoucat');
    }

    public function categorie()
    {
      return $this->belongsTo('App\Models\Categorie', 'idcategorie');
    }
}
