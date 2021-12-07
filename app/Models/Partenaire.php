<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_parte
 * @property string $logo_part
 * @property string $titre_part
 * @property boolean $flag_part
 * @property int $id_user
 * @property string $created_at
 * @property string $updated_at
 */
class Partenaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partenaire';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_parte';

    /**
     * @var array
     */
    protected $fillable = ['logo_part', 'titre_part', 'flag_part', 'id_user', 'created_at', 'updated_at'];

}
