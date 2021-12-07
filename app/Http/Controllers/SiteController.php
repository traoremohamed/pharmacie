<?php

namespace App\Http\Controllers;


use App\Models\Fichier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site;
use DB;
use Auth;
use Session;

class SiteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*function __construct()
    {
        $this->middleware('permission:liste-site');
        $this->middleware('permission:voir-site');

    }*/


    public function index(Request $request)
    {

        $idutil = Auth::user()->id;
        // dd($idutil);

        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        $sites = Site::all();


        return view('site.index', compact('tabl', 'sites', 'naroles'));
    }

    public function create(Request $request)
    {
        $idutil = Auth::user()->id;
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        $naroles = $roles->name;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        if ($request->isMethod('post')) {

            $data = $request->all();
            $site = new Site;
            $site->lib_site = $data['lib_site'];
            $site->longitude_site = $data['longitude_site'];
            $site->latitude_site = $data['latitude_site'];
            $site->flag_site = 1;

            if (isset($request->fichier_site)) {
                $fileName = 'fichiersite' . '_' . time() . '.' . $request->fichier_site->extension();
                $request->fichier_site->move(public_path('fichiersite'), $fileName);
                $site->fichier_site = $fileName;
            }
            $site->save();
            return redirect('/site')->with('success', 'Enregistrement avec succes');
        }
        return view('site.create', compact('tabl', 'naroles'))->with('success', 'site creer avec succes');
    }

    public
    function edit(Request $request, $id = null)
    {
        $idutil = Auth::user()->id;
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        $naroles = $roles->name;
        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {
            $tabl[$ligne->id_menu][] = $ligne;
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            //  dd($data);die();
            if (isset($data['fichier_site'])) {
                $fileName = 'fichiersite' . '_' . time() . '.' . $request->fichier_site->extension();
                $request->fichier_site->move(public_path('fichiersite'), $fileName);
                Site::where(['id_site' => $id])->update(
                    [
                        'lib_site' => $request->input('lib_site'),
                        'longitude_site' => $request->input('longitude_site'),
                        'latitude_site' => $request->input('latitude_site'),
                        'fichier_site' => $fileName
                    ]);
            } else {
                Site::where(['id_site' => $id])->update(
                    [
                        'lib_site' => $request->input('lib_site'),
                        'longitude_site' => $request->input('longitude_site'),
                        'latitude_site' => $request->input('latitude_site')
                    ]);
            }
            return redirect()->route('site')->with('success', ' Succes : Modification reussi.');
        }

        $site = Site::where([['id_site', '=', $id]])->first();
        return view('site.edit',
            compact('tabl', 'naroles', 'site'));
    }

    public
    function desactive(Request $request, $id = null)
    {

        $idutil = Auth::user()->id;
        // dd($idutil);

        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        Site::where([['id_site', '=', $id]])->update(['flag_site' => 0]);

        return redirect()->route('site')->with('success', ' Succes : desactivation reussi.');

    }


    public
    function active(Request $request, $id = null)
    {

        $idutil = Auth::user()->id;
        // dd($idutil);

        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        Site::where([['id_site', '=', $id]])->update(['flag_site' => 1]);

        return redirect()->route('site')->with('success', ' Succes : desactivation reussi.');


    }


    public function show($id = null)
    {

        $site = Site::where([['id_site', '=', $id]])->first();

        $resfichiersImage = DB::table('fichier')->where([['id_param', '=', $id], ['code_fichier', '=', 'SI'], ['fichier_video', '=', null]])->get();
        $resfichiersVideo = DB::table('fichier')->where([['id_param', '=', $id], ['code_fichier', '=', 'SI'], ['fichier_image', '=', null]])->get();

        return view('site.show', compact( 'site', 'resfichiersImage', 'resfichiersVideo'));
    }


    public function ajouterfi(Request $request, $id = null)
    {


        $idutil = Auth::user()->id;
        // dd($idutil);

        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        $naroles = $roles->name;

        $resulat = DB::table('role_has_sousmenus')
            ->join('sousmenu', 'role_has_sousmenus.sousmenus_id_sousmenu', 'sousmenu.id_sousmenu')
            ->join('roles', 'role_has_sousmenus.role_id', 'roles.id')
            ->join('menu', 'sousmenu.menu_id_menu', 'menu.id_menu')
            ->where([['roles.id', '=', $idroles]])
            ->get();

        $tabl = [];

        foreach ($resulat as $ligne) {

            $tabl[$ligne->id_menu][] = $ligne;
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if (isset($data['fichier_image']) and isset($data['fichier_video'])) {
                return view('site.ajouterfichier', compact('tabl', 'naroles', 'site', 'id', 'resfichiersImage', 'resfichiersVideo'));
            }

            $fichiers = new Fichier();

            $fichiers->id_param = $id;

            if (isset($data['fichier_image'])) {
                $fileName = 'fichierjointesite' . '_' . time() . '.' . $request->fichier_image->extension();
                $request->fichier_image->move(public_path('fichierjointe'), $fileName);
            } else {
                $fileName = null;
            }
            $res = null;
            if (isset($data['fichier_video'])) {
                $res1 = explode("/", $data['fichier_video']);
                //dd($res1);die();

                $res = 'https://www.youtube.com/embed/' . $res1[3];
                //dd($res);die();
            }
            $fichiers->fichier_image = $fileName;
            $fichiers->fichier_video = $res;
            $fichiers->code_fichier = 'SI';

            $fichiers->save();


        }

        $site = Site::where([['id_site', '=', $id]])->first();

        $resfichiersImage = DB::table('fichier')->where([['id_param', '=', $id], ['code_fichier', '=', 'SI'], ['fichier_video', '=', null]])->get();
        $resfichiersVideo = DB::table('fichier')->where([['id_param', '=', $id], ['code_fichier', '=', 'SI'], ['fichier_image', '=', null]])->get();
//dd($resfichiersVideo);

        return view('site.ajouterfichier', compact('tabl', 'naroles', 'site', 'id', 'resfichiersImage', 'resfichiersVideo'));
    }
}
