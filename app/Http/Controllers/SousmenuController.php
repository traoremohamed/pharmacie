<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Sousmenus;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Session;

class SousmenuController extends Controller
{
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


         $data = Sousmenus::all();
        return view('sousmenus.index',compact('tabl','data', 'naroles'));
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


        $menuss = Menus::get();

        /*$stocks = Stock::where(['flag_statut'=>1])->orderby('created_at','DESC')->get();*/


        $menus = "<option selected disabled>Select</option>";
                foreach ($menuss as $comp ) {
                            $menus .= "<option value='".$comp->id_menu."'>".$comp->menu."</option>";
                 }
      //  dd($menus);
        return view('sousmenus.create',compact('tabl','menus', 'naroles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /*$this->validate($request, [
            'sousmenu' => 'required',
            //'permission' => 'required',
        ]);*/

        // dd($request->all());

         Sousmenus::create(['menu_id_menu' => $request->input('menus'), 'sousmenu' => $request->input('sousmenu'), 'libelle' => $request->input('libelle')]);


         return redirect()->route('sousmenus.index')
                        ->with('success',' Succes : Enregistrement reussi.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \App\Sousmenus  $sousmenus
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


       // dd($id);
        $sousmenus = Sousmenus::where([['id_sousmenu','=',$id]])->first();
        return view('sousmenus.show',compact('tabl','sousmenus','naroles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

        $sm = DB::table('sousmenu')->join('menu', 'sousmenu.menu_id_menu','menu.id_menu')->where([['sousmenu.id_sousmenu','=',$id]])->first();

       // dd($sm->menu);

        $selectsousmenu = $sm->menu;

        $menuss = Menus::get();

        $menus = "<option selected value='$sm->menu_id_menu'>$selectsousmenu</option>";
                foreach ($menuss as $comp ) {
                            $menus .= "<option value='".$comp->id_menu."'>".$comp->menu."</option>";
                 }

        $sousmenus = Sousmenus::where([['id_sousmenu','=',$id]])->first();
        return view('sousmenus.edit',compact('tabl','menus','sousmenus','naroles'));
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

        /*request()->validate([
            'sousmenu' => 'required',
            //'guard_name' => 'required',
        ]);*/

        Sousmenus::where(['id_sousmenu' =>$id])->update(['menu_id_menu'=>$request->input('menus'), 'sousmenu' => $request->input('menu'), 'libelle' => $request->input('libelle')]);

      //  dd($request->all());

         return redirect()->route('sousmenus.index')
                        ->with('success','Succes : Enregistrement reussi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
