<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_temoi
 * @property string $message_temoin
 * @property int $id_user
 * @property string $nom_prenom
 * @property boolean $flag_temoi
 * @property string $image_temoi
 * @property string $created_at
 * @property string $updated_at
 */
class Temoignange extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'temoignange';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_temoi';

    /**
     * @var array
     */
    protected $fillable = ['message_temoin', 'id_user', 'nom_prenom', 'flag_temoi', 'image_temoi', 'created_at', 'updated_at'];

}
