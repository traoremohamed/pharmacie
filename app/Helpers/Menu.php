<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Menu
{
    public static function get_menu($idutil)
    {


        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->orderBy('sousmenu.priorite_sousmenu', 'ASC')
            ->orderBy('menu.priorite_menu', 'ASC')
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        return (isset($tabl) ? $tabl : '');
    }

    public static function get_menu_profil($idutil)
    {


        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;


        return (isset($naroles) ? $naroles : '');
    }

    public static function get_code_menu_profil($idutil)
    {


        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $coderoles = $roles->code_roles;


        return (isset($coderoles) ? $coderoles : '');
    }
}
