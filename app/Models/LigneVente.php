<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneVente extends Model
{
    // 
    public function article()
    {
        return $this->belongsTo('App\Models\Article', 'idarticle');
    } 

    public function bodereauLivraison()
    {
        return $this->belongsTo('App\Models\BordereauLivraison', 'idbrdliv');
    }
}
