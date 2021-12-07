<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sous_menu_front
 * @property int $menu_front_id_menu_front
 * @property string $libelle_sous_menu_front
 * @property float $priorite_sous_menu_front
 * @property string $sous_menu_front
 * @property boolean $flag_menu_front
 * @property string $created_at
 * @property string $updated_at
 */
class SousMenuFront extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sous_menu_front';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_sous_menu_front';

    /**
     * @var array
     */
    protected $fillable = ['menu_front_id_menu_front', 'libelle_sous_menu_front', 'priorite_sous_menu_front', 'sous_menu_front', 'flag_menu_front', 'created_at', 'updated_at'];

}
