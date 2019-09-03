<?php

namespace App;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //  
    protected $fillable = ['nom', 'prenom', 'adresse', 'telephone', 'created_at', 'updated_at']; 
    
    public function bordereauLivraison()
    {
        return $this->hasMany('App\Models\BordereauLivraison', 'idclient'); 
    }
}
