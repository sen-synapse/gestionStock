<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneArticleRecus extends Model
{
    //

    protected $fillable = ['idbrdfourniss', 'idarticle', 'iduser', 'quantite', 'couleur', 'created_at', 'updated_at'];

    public function bordereauFournisseurs()
    {
      return $this->belongsTo('App\Models\BordereauFournisseur', 'idbrdfourniss');
    }

    public function article()
    {
      return $this->belongsTo('App\Models\Article', 'idarticle');
    }

    public function user()
    {
      return $this->belongsTo('App\Users',  'iduser');
    }
}
