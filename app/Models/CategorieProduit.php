<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_cat_prod
 * @property string $libelle_cat_prod
 * @property boolean $flag_cat_prod
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class CategorieProduit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_produit';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_cat_prod';

    /**
     * @var array
     */
    protected $fillable = ['libelle_cat_prod', 'flag_cat_prod', 'id_user', 'created_at', 'updated_at'];

}
