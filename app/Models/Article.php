<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['codearticle', 'idsoucat', 'article', 'unitearticle', 'dimension', 'created_at', 'updated_at'];

    public function sousCategories()
    {
      return $this->belongsTo('App\Models\SousCategories', 'idsoucat');
    }

    public function ligneArticleRecus()
    {
      return $this->hasMany('App\Models\LigneArticleRecus', 'idarticle');
    }
}