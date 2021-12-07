<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Session;


class PermissionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
         $this->middleware('permission:product-list');
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }*/

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

        $data = Permissions::all();
        return view('permissions.index',compact('tabl','data','naroles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

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

        return view('permissions.create',compact('tabl','naroles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            //'guard_name' => 'required',
        ]);


        Permissions::create(['name' => $request->input('name'), 'guard_name'=> 'web']);


        return redirect()->route('permissions.index')
                        ->with('success','Permissions created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permissions  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permissions $permission)
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

        return view('permissions.show',compact('tabl','permission','naroles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permissions  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissions $permission)
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

        return view('permissions.edit',compact('tabl','permission', 'naroles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permissions  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permissions  $permission)
    {
        request()->validate([
            'name' => 'required',
            //'guard_name' => 'required',
        ]);


        $permission->update(['name' => $request->input('name'),'guard_name'=> 'web']);


        return redirect()->route('permissions.index')
                        ->with('success','Permissions created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permissions  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissions  $permission)
    {
       $permission->delete();


        return redirect()->route('permissions.index')
                        ->with('success','Permission deleted successfully');
    }
}
