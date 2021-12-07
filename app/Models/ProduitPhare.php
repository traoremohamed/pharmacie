<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_prod_ph
 * @property string $titre_prod_ph
 * @property string $description_prod_ph
 * @property string $image_prod_ph
 * @property string $video_prod_ph
 * @property boolean $flag_prod_ph
 * @property int $id_user
 * @property int $id_cat_prod
 * @property string $lien_produit_phare
 * @property string $created_at
 * @property string $updated_at
 */
class ProduitPhare extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produit_phare';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_prod_ph';

    /**
     * @var array
     */
    protected $fillable = ['titre_prod_ph', 'description_prod_ph', 'image_prod_ph', 'video_prod_ph', 'flag_prod_ph', 'id_cat_prod', 'lien_produit_phare', 'id_user', 'created_at', 'updated_at'];

}
