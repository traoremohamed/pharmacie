<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Helpers\Crypt;
use App\Helpers\Envoisms;
use App\Helpers\Email;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pays;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /******************  UTILISATEUR CONNECTé************************/
        $idutil = Auth::user()->id;

        /******************ROLE DE LUTILISATEUR CONNECTé************************/
        $roles = DB::table('users')
            ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where([['users.id', '=', $idutil]])
            ->first();
        $idroles = $roles->role_id;
        //dd($idroles);

        /****************** Afficheé le menu en fonction du role de l'utilisateur ***********************/
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

        $data = User::where([['flag_actif_users','=',true],['flag_demission_users','=',false],['flag_admin_users','=',false]])->get();
		//DB::table('users')->where([['flag_actif_users','=',true],['flag_demission_users','=',false],['flag_admin_users','=',false]])->get();
		//User19102021::all();

        return view('users.index', compact('data', 'tabl', 'naroles'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::where([['id', '!=', 4]])->get()->pluck('name', 'name');
        $Pays = Pays::get();
		$val='';
         foreach ($Pays as $comp) {
			if($comp->indicatif =='225') { $val='selected=selected';};
             $Pays .= "<option  value='".$comp->indicatif ."' ".$val."    > +"  . $comp->indicatif . " </option>";
			 $val='';
        }
		//var_dump($Pays);
        return view('users.create', compact(  'roles' ,'Pays' ));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $key = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        /* $resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

        $idutil = Auth::user()->id;
        // dd($idutil);



        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'cel_users' => 'required'
        ]);


        $input = $request->all();

        $pass = $key . '+' . $input['password'];

        $input['password'] = Hash::make($input['password']);

        // dd($input);die();

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'Succes : Enregistrement reussi');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

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

        $user = User::find($id);
        return view('users.show', compact('tabl', 'user', 'naroles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();


        return view('users.edit', compact('user', 'roles', 'userRole'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $key = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        /*$resulat = DB::table('menu')->join('sousmenu','menu.id_menu','sousmenu.menu_id_menu')->get();*/

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

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();


        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }


        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'Succes : Enregistrement reussi');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User19102021 deleted successfully');
    }


    public function compteclient(Request $request, $id = null)
    {

        $id = \App\Helpers\Crypt::UrldeCrypt($id);


        $idutil = Auth::user()->id;

        $roles = Role::where([['id', '=', 4]])->first();
        $client = DB::table('client')->where([['id_cli', '=', $id]])->get()[0];


        $name = $client->nom_cli;
        $prenom_users = $client->prenom_cli;
        $emailcli = $client->email_cli;
        $id_partenaire = $client->id_cli;
        $cel_users = $client->cel_cli;
        $tel_users = $client->tel_domicile_cli;
        $adresse_users = $client->bp_cli;
        $role = $roles->name;
        // dd($emailcli);
        $clientrech = DB::table('users')->where([['email', '=', $emailcli]])->get();
        // dd($clientrech);
        if (count($clientrech) > 0) {
            return redirect()->route('client')
                ->with('danger', 'Echec : Le compte du client ' . $name . ' ' . $prenom_users . ' a déjà été créé !');
        }

        $clientrechnum = DB::table('users')->where([['cel_users', '=', $cel_users]])->get();
        // dd($clientrech);
        if (count($clientrechnum) > 0) {
            return redirect()->route('client')
                ->with('danger', 'Echec : Le compte du client ' . $name . ' ' . $prenom_users . ' a déjà été créé !');
        }

        $passwordCli = Crypt::MotDePasse();// '123456789';
        $password = Hash::make($passwordCli);


        $user = new User();
        $user->name = $name;
        $user->prenom_users = $prenom_users;
        $user->email = $emailcli;
        $user->id_partenaire = $id_partenaire;
        $user->password = $password;
        $user->cel_users = $cel_users;
        $user->tel_users = $tel_users;
        $user->adresse_users = $adresse_users;

        $user->assignRole($role);
        $user->save();

        Client::where([['id_cli', '=', $id]])->update(['flag_compte' => 1]);

        /*************** DEBUT ENVOI DE SMS *********************/
        if (isset($emailcli)) {
            $messages = 'Bonjour ' . $client->nom_cli . ' ' . $client->prenom_cli . ', Votre compte sur la plateforme de Victoire immobilier est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $emailcli . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien : http://app.victoireimmobilier.ci ';

        } elseif ($cel_users) {
            $messages = 'Bonjour ' . $client->nom_cli . ' ' . $client->prenom_cli . ', Votre compte sur la plateforme de Victoire immobilier est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $cel_users . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien : http://app.victoireimmobilier.ci ';
        } else {

        }

        $message = $messages;
        $contactClient = str_replace(' ', '', $client->cel_cli);
        if (isset($contactClient)) {
            Envoisms::get_envoisms($client->indicatif_cel_cli.$contactClient, $message);
        }
        /*************** FIN ENVOI DE SMS *********************/

        /*************** DEBUT ENVOI DE EMAIL *********************/

        if (isset($emailcli)) {
            $sujet = "Activation de compte";
            $titre = "Bienvenue sur Victoire immobilier";
            $messageMail = "<b>Bonjour  $client->nom_cli   $client->prenom_cli ,</b>
                            <br><br>Veuillez trouver ci-après, vos accès à la plateforme de Victoire immobilier .
                            <br><br>
                            <br><b>Identifiant : </b> $emailcli
                            <br><b>Mot de passe : </b> $passwordCli
                            <br><br><br>
                            -----
                            Ceci est un mail automatique, Merci de ne pas y répondre.
                            -----
                            ";


            $messageMailEnvoi = Email::get_envoimailTemplate($client->email_cli, $client->nom_cli, $messageMail, $sujet, $titre);
        }
        /*************** FIN ENVOI DE EMAIL *********************/
        // dd($messageMailEnvoi);


        return redirect()->route('client')
            ->with('success', 'Succes : Création de compte utilisateur réussi');
    }
}
