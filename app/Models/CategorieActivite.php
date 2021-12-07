<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_categ
 * @property string $lib_categ
 * @property boolean $flag_categ
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class CategorieActivite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorie_activite';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_categ';

    /**
     * @var array
     */
    protected $fillable = ['lib_categ', 'id_user', 'flag_categ', 'created_at', 'updated_at'];

}
