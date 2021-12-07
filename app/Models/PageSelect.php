<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class PageSelect extends Model
{
    public static function getSite()
    {
        $site = DB::table('site')->orderBy('id_site','asc')->get();

        return $site;
    }

    public static  function  getLotissement($site=0)
    {
        $lotis = DB::table('lotissement')->where('id_site',$site)->get();
        return $lotis;
    }

    public static function  getLotissemen()
    {
      $loti = DB::table('lotissement')->get();
      return $loti;
    }

    public static  function getLot($loti=0)
    {
        $lot = DB::table('lot')->where([['id_loti', '=', $loti], ['flag_bloquer_lot', '=', false]])->get();
        return $lot;

        /*
          $lot = DB::table('lot')->join('reservationcom')->where('id_loti', $loti)->get();
        return $lot;
         */
    }
}
