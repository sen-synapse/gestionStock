<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BordereauLivraison extends Model
{
    // 
    protected $fillable = ['idclient', 'datebrd', 'fichier', 'created_at', 'updated_at']; 

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'idclient');
    } 

    public function ligneVente()
    {
        return $this->hasMany('App\Models\LigneVente', 'idbrdliv');
    }
}
