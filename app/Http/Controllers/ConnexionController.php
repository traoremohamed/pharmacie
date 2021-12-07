<?php

namespace App\Http\Controllers;

use App\Helpers\Crypt;
use App\Helpers\Email;
use App\Helpers\Envoisms;
use App\Helpers\Menu;
use App\Models\Lot;
use App\Models\Site;
use App\Models\Prospection;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
use Hash;

use App\Helpers\Notification;


class ConnexionController extends Controller
{
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function login(Request $request)
    {

        $key = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required',
                'captcha' => 'required|captcha'

            ]);
            $data = $request->input();

            $pass = $key . '+' . $data['password'];
//dd($data);die();
            if (Auth::attempt(['email' => $data['username'], 'password' => $data['password']])) {
                // echo "succes";die;

                $dbinfo = DB::table('users')->where([['email', '=', $data['username']]])->first();
                $flag = $dbinfo->flag_mdp;
                if ($flag == true) {
                    Session::put('userSession', $data['username']);
                } else {
                    return redirect('/modifiermotdepasse')->with('success', 'Succes:  Nous vous demandons de modifier votre mot de passe a la premiere connexion');
                    }

                return redirect('/dashboard')->with('success', 'Bonjour ' . Auth::user()->name . ' ' . Auth::user()->prenom_users . ',  Bienvenue sur le portail de gna assurance');

            } elseif (Auth::attempt(['cel_users' => $data['username'], 'password' => $data['password']])) {

                //  echo "succes";die;

                $dbinfo = DB::table('users')->Where([['cel_users', '=', $data['username']]])->first();
                $flag = $dbinfo->flag_mdp;
                if ($flag == true) {
                    Session::put('userSession', $data['username']);
                } else {
                    return redirect('/modifiermotdepasse');
                }

                return redirect('/dashboard')->with('success', 'Bonjour ' . Auth::user()->name . ' ' . Auth::user()->prenom_users . ',  Bienvenue sur le portail de victoire immobilier');

            } else {

                return redirect('/connexion')->with('error', 'Mot de passe ou email incorrect');

            }
        }

        return view('connexion.login');
    }


    public function dashboard()
    {

        if (Session::has('userSession')) {
        } else {
            return redirect('/login')->with('error', 'Veuillez vous identifié');
        }

        $idutil = Auth::user()->id;
        $idutilClient = Auth::user()->id_partenaire;


        $naroles = Menu::get_menu_profil($idutil);

        $nacodes = Menu::get_code_menu_profil($idutil);

        // dd($nacodes);die();


        $dataUser = User::where([['flag_actif_users','=',true],['flag_demission_users','=',false],['flag_admin_users','=',false]])->get();





        return view('dashboard.dashboard')->with(
            compact('naroles', 'dataUser', 'idutilClient', 'nacodes')
        );
    }


	public function motdepasseoublie(Request $request){

        if ($request->isMethod('post')) {


            $this->validate($request, [
                'username' => 'required',
            ]);

            $data = $request->input();

            $resultat = DB::table('users')->where([['email','=',$data['username']]])->orwhere([['cel_users','=',$data['username']]])->first();

            //dd($resultat);die();

            if (isset($resultat)){

                //dd($resultat->id);die();

                $passwordCli = Crypt::MotDePasse();// '123456789';
                $password = Hash::make($passwordCli);

                User::where([['id','=',$resultat->id]])->update(['password'=>$password, 'flag_mdp'=>0]);

                if (isset($resultat->email)){

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Victoire immobilier est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->email . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien : http://app.victoireimmobilier.ci ';

                }

                if (isset($resultat->cel_users)){

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Victoire immobilier est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->cel_users . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien : http://app.victoireimmobilier.ci ';

                }

				if (isset($resultat->email) and isset($resultat->cel_users) ){

                    $messages = 'Bonjour ' . $resultat->name . ' ' . $resultat->prenom_users . ', Votre compte sur la plateforme de Victoire immobilier est disponible. ' . chr(13) . chr(10) . 'Voici vos acces: ' . chr(13) . chr(10) . 'Identifiant : ' . $resultat->email . ' ' . chr(13) . chr(10) . 'Mot de passe : ' . $passwordCli . ' ' . chr(13) . chr(10) . 'Lien : http://app.victoireimmobilier.ci ';

                }


                $message = $messages;
                $contactClient = str_replace(' ', '', $resultat->cel_users);

                if (isset($contactClient) and !isset($resultat->email)){

                    Envoisms::get_envoisms($resultat->indicatif_cel_users.$contactClient, $message);
                }

                if (isset($resultat->email) and !isset($resultat->cel_users)){

                    $sujet = "Renouvellement des acces";
                    $titre = "Bienvenue sur Victoire immobilier";
                    $messageMail = "<b>Bonjour  $resultat->name   $resultat->prenom_users ,</b>
                            <br><br>Veuillez trouver ci-après, vos accès à la plateforme de Victoire immobilier .
                            <br><br>
                            <br><b>Identifiant : </b> $resultat->email
                            <br><b>Mot de passe : </b> $passwordCli
                            <br><br><br>
                            -----
                            Ceci est un mail automatique, Merci de ne pas y répondre.
                            -----
                            ";


                    $messageMailEnvoi = Email::get_envoimailTemplate( $resultat->email, $resultat->name, $messageMail,  $sujet, $titre );

                }

				 if (isset($resultat->email) and isset($resultat->cel_users)){

                    $sujet = "Renouvellement des acces";
                    $titre = "Bienvenue sur Victoire immobilier";
                    $messageMail = "<b>Bonjour  $resultat->name  $resultat->prenom_users  ,</b>
                            <br><br>Veuillez trouver ci-après, vos accès à la plateforme de Victoire immobilier .
                            <br><br>
                            <br><b>Identifiant : </b>  $resultat->email
                            <br><b>Mot de passe : </b>  $passwordCli
                            <br><br><br>
                            -----
                            Ceci est un mail automatique, Merci de ne pas y répondre.
                            -----
                            ";


                    $messageMailEnvoi = Email::get_envoimailTemplate( $resultat->email, $resultat->name, $messageMail, $sujet, $titre );

                    Envoisms::get_envoisms($resultat->indicatif_cel_users.$contactClient, $message);

				    //dd($messageMailEnvoi);
                }

                return redirect('motdepasseoublie')->with('success','Vos acces ont été envoyés par SMS et Email');

            }else{
                return  redirect('motdepasseoublie')->with('error','Erreur nous avons pas trouvé votre compte');
            }
        }

        return view('connexion.motdepasseoublie');
    }
}
