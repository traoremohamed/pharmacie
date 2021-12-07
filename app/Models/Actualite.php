<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_actualite
 * @property string $titre_actualite
 * @property string $description_actualite
 * @property string $image_actualite
 * @property boolean $flag_actualite
 * @property int $id_user
 * @property int $id_cat
 * @property string $date_pub_actu
 * @property string $lien_text_actu
 * @property string $created_at
 * @property string $updated_at
 */
class Actualite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'actualite';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_actualite';

    /**
     * @var array
     */
    protected $fillable = ['titre_actualite', 'description_actualite', 'image_actualite', 'flag_actualite', 'id_user', 'id_cat', 'lien_text_actu', 'date_pub_actu', 'created_at', 'updated_at'];

}
