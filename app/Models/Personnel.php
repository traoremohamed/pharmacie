<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_personnel
 * @property string $nom_personnel
 * @property string $prenom_personnel
 * @property string $fonction_personnel
 * @property string $mot_personnel
 * @property string $date_debut_fonction
 * @property string $date_fin_fonction
 * @property string $image_personnel
 * @property int $id_user
 * @property boolean $flag_retraite
 * @property boolean $flag_personnel
 * @property boolean $flag_actif_responsable
 * @property string $rs_fb
 * @property string $rs_tw
 * @property string $rs_wha
 * @property string $rs_gm
 * @property string $created_at
 * @property string $updated_at
 * @property string $rs_li
 * @property string $rs_yo
 * @property string $rs_be
 */
class Personnel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personnel';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_personnel';

    /**
     * @var array
     */
    protected $fillable = ['nom_personnel', 'prenom_personnel', 'fonction_personnel', 'mot_personnel', 'date_debut_fonction', 'date_fin_fonction', 'image_personnel', 'id_user', 'flag_retraite', 'flag_personnel', 'flag_actif_responsable', 'rs_fb', 'rs_tw', 'rs_wha', 'rs_gm', 'created_at', 'updated_at', 'rs_li', 'rs_yo', 'rs_be'];

}
