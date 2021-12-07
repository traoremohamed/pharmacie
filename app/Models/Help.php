<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_help
 * @property string $nom_prenom_help
 * @property string $fonction_help
 * @property string $description_help
 * @property boolean $flag_help
 * @property string $photo_help
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Help extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'help';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_help';

    /**
     * @var array
     */
    protected $fillable = ['nom_prenom_help', 'fonction_help', 'description_help', 'flag_help', 'photo_help', 'id_user', 'created_at', 'updated_at'];

}
