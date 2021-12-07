<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_gest_pers
 * @property string $nom_gest_pers
 * @property string $fonc_gest_pers
 * @property string $desc_gest_pers
 * @property string $image_gest_pers
 * @property float $ordre_gest_pers
 * @property boolean $flag_gest_pers
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class GestionPersonnel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gestion_personnel';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_gest_pers';

    /**
     * @var array
     */
    protected $fillable = ['nom_gest_pers', 'fonc_gest_pers', 'desc_gest_pers', 'image_gest_pers', 'ordre_gest_pers', 'flag_gest_pers', 'id_user', 'created_at', 'updated_at'];

}
