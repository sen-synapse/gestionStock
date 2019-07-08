<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $idfourniss
 * @property string $datebrd
 * @property string $fichier
 * @property string $created_at
 * @property string $updated_at
 * @property Fournisseur $fournisseur
 * @property LigneArticlerecus[] $ligneArticlerecuses
 */
class BordereauFournisseur extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['idfourniss', 'datebrd', 'fichier', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur()
    {
        return $this->belongsTo('App\Models\Fournisseur', 'idfourniss');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ligneArticlerecus()
    {
        return $this->hasMany('App\Models\LigneArticleRecus', 'idbrdfourniss');
    }
}
