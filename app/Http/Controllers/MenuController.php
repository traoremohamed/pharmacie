<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menus;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Session;

class MenuController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

         /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

         $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }

        $data = Menus::all();

        $jsdata = Menus::all()->toJson();

      //  $jsdata = json_encode($datas);

       // dd($jsdata);

        return view('menus.index',compact('tabl','data','jsdata','naroles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

        $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }

        return view('menus.create')->with(compact('tabl','naroles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* $resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

        $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }


        request()->validate([
            'menu' => 'required',
            //'guard_name' => 'required',
        ]);


        Menus::create(['menu' => $request->input('menu'),'guard_name' => 'web']);


        return redirect()->route('menus.index')
                        ->with('success','Menu created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menus  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menus $menu)
    {

         /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

         $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }

        return view('menus.show',compact('tabl','menu','naroles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menus  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menus $menu)
    {
         /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

         $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }
        return view('menus.edit',compact('tabl','menu', 'naroles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menus  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menus $menu)
    {
        request()->validate([
            'menu' => 'required',
            //'guard_name' => 'required',
        ]);


        $menu->update(['menu' => $request->input('menu')]);


        return redirect()->route('menus.index')
                        ->with('success','Menu created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menus $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menus $menu)
    {
         $menu->delete();


        return redirect()->route('menus.index')
                        ->with('success','Menu deleted successfully');
    }

    public function lnmenus($value='')
    {

        exit('testt');
         $idutil=Auth::user()->id;
       // dd($idutil);

        $roles = DB::table('users')
                    ->join('model_has_roles','users.id','model_has_roles.model_id')
                    ->join('roles','model_has_roles.role_id','roles.id')
                    ->where([['users.id','=',$idutil]])
                    ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

         $resulat = DB::table('role_has_sousmenus')
                ->join('sousmenu','role_has_sousmenus.sousmenus_id_sousmenu','sousmenu.id_sousmenu')
                ->join('roles','role_has_sousmenus.role_id','roles.id')
                ->join('menu','sousmenu.menu_id_menu','menu.id_menu')
                ->where([['roles.id','=',$idroles]])
                ->get();

    $tabl = [];

    foreach ($resulat as $ligne) {

        $tabl[$ligne->id_menu][] = $ligne;
    }

        $data = Menus::orderBy('id_menu','DESC')->paginate(5);
        return view('menus.lnindex',compact('tabl','data'));
    }
}
