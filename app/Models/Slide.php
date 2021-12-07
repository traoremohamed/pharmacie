<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_slide
 * @property string $titre_slide
 * @property string $description_slide
 * @property string $image_slide
 * @property int $id_user
 * @property boolean $flag_slide
 * @property string $libelle_bouton_slide
 * @property string $lien_bouton_slide
 * @property string $type_fichier
 * @property string $created_at
 * @property string $updated_at
 */
class Slide extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slide';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_slide';

    /**
     * @var array
     */
    protected $fillable = ['titre_slide', 'description_slide', 'image_slide', 'id_user', 'flag_slide','libelle_bouton_slide', 'lien_bouton_slide', 'type_fichier', 'created_at', 'updated_at'];

}
