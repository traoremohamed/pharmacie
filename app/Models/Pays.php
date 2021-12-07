<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pays
 * @property string $libelle_pays
 * @property string $nationalite_pays
 * @property string $updated_at
 * @property string $created_at
 * @property string $indicatif
 * @property Client[] $clients
 */
class Pays extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pays';

    /**
     * @var array
     */
    protected $fillable = ['libelle_pays', 'nationalite_pays', 'updated_at', 'created_at', 'indicatif'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients()
    {
        return $this->hasMany('App\Models\Client', 'id_pays', 'id_pays');
    }
}
