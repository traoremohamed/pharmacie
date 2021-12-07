<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_gest_page
 * @property string $nom_tech_gest_page
 * @property string $nom_pub_gest_page
 * @property string $descrp_gest_page
 * @property float $ordre_gest_page
 * @property boolean $flag_gest_page
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class GestionPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gestion_page';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_gest_page';

    /**
     * @var array
     */
    protected $fillable = ['nom_tech_gest_page', 'nom_pub_gest_page', 'descrp_gest_page', 'ordre_gest_page', 'flag_gest_page', 'id_user', 'created_at', 'updated_at'];

}
