<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_banner
 * @property string $titre_banner
 * @property string $image_banner
 * @property boolean $flag_banner
 * @property string $created_at
 * @property string $updated_at
 */
class Banner extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'banner';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_banner';

    /**
     * @var array
     */
    protected $fillable = ['titre_banner', 'image_banner', 'flag_banner', 'created_at', 'updated_at'];

}
