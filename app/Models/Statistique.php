<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_stat
 * @property string $libelle_stat
 * @property string $stat_stat
 * @property boolean $flag_stat
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Statistique extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statistique';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_stat';

    /**
     * @var array
     */
    protected $fillable = ['libelle_stat', 'stat_stat', 'flag_stat', 'id_user', 'created_at', 'updated_at'];

}
