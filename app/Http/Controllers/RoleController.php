<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Auth;
use Session;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:role-list');
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


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


        $roles = Role::all();
        return view('roles.index',compact('tabl','roles','naroles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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



        $permission = Permission::get();
        return view('roles.create',compact('tabl','permission','naroles'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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


        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('roles.show',compact('tabl','role','rolePermissions','naroles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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


        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();


        return view('roles.edit',compact('tabl','role','permission','rolePermissions','naroles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));


        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
