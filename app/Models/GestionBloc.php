<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_gest_bloc
 * @property int $id_gestion_page
 * @property string $nom_tech_gest_bloc
 * @property string $nom_pub_gest_bloc
 * @property string $descrp_gest_bloc
 * @property float $ordre_gest_bloc
 * @property string $bloc_parent
 * @property boolean $flag_bloc
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class GestionBloc extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gestion_bloc';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_gest_bloc';

    /**
     * @var array
     */
    protected $fillable = ['id_gestion_page', 'nom_tech_gest_bloc', 'nom_pub_gest_bloc', 'descrp_gest_bloc', 'ordre_gest_bloc', 'bloc_parent', 'flag_bloc', 'id_user', 'created_at', 'updated_at'];

}
