<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $raisonsocial
 * @property string $email
 * @property string $telephone
 * @property string $adresse
 * @property string $responsable
 * @property string $bureautel
 * @property string $fax
 * @property string $numcomptebank
 * @property string $created_at
 * @property string $updated_at
 * @property BordereauFournisseur[] $bordereauFournisseurs
 */
class Fournisseur extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['raisonsocial', 'email', 'telephone', 'adresse', 'responsable', 'bureautel', 'fax', 'numcomptebank', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bordereauFournisseurs()
    {
        return $this->hasMany('App\Models\BordereauFournisseur', 'idfourniss');
    }
}
