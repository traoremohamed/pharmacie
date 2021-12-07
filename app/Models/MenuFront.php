<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_menu_front
 * @property string $nenu_front
 * @property float $priorite_menu_front
 * @property string $created_at
 * @property string $updated_at
 * @property boolean $flag_menu_front
 */
class MenuFront extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menu_front';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_menu_front';

    /**
     * @var array
     */
    protected $fillable = ['nenu_front', 'priorite_menu_front', 'created_at', 'updated_at', 'flag_menu_front'];

}
