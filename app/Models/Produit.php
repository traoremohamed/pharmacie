<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_produit
 * @property string $titre_produit
 * @property string $description_produit
 * @property string $icon_produit
 * @property string $image_produit
 * @property int $id_user
 * @property int $id_cat_produit
 * @property string $lien_produit
 * @property boolean $flag_produit
 * @property string $created_at
 * @property string $updated_at
 */
class Produit extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produit';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_produit';

    /**
     * @var array
     */
    protected $fillable = ['titre_produit', 'description_produit', 'icon_produit', 'image_produit', 'id_user', 'id_cat_produit', 'lien_produit', 'flag_produit', 'created_at', 'updated_at'];

}
