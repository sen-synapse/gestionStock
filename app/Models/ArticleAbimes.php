<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleAbimes extends Model
{
    // 
    protected $fillable = ['idarticle', 'iduser', 'nbrePiece', 'couleur', 'created_at', 'updated_at'];

    public function articles()
    {
      return $this->belongsTo('App\Models\Article', 'idarticle');
    }

    public function user()
    {
      return $this->belongsTo('App\Users',  'iduser');
    }
}
