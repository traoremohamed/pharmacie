<?php

namespace App\Http\Controllers;


use App\Models\Banner;
use App\Models\Help;
use App\Models\Logo;
use App\Models\Partenaire;
use App\Models\Personnel;
use App\Models\Slide;
use App\Models\Produit;
use App\Models\Actualite;
use App\Models\ProduitPhare;
use App\Models\Statistique;
use App\Models\Temoignange;
use App\Models\CategorieActivite;
use App\Models\GestionPage;
use App\Models\GestionBloc;
use App\Models\GestionPersonnel;
use App\Models\MenuFront;
use App\Models\SousMenuFront;
use App\Models\CategorieProduit;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Session;

class ParametrageController extends Controller
{
    public function slide(){

        $slides = DB::table('slide')->get();

        return view('slide.index',compact('slides'));
    }

    public function creationslide(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $slide = new Slide;

            $slide->titre_slide = $data['titre_slide'];
            $slide->description_slide = $data['description_slide'];
            $slide->id_user = $idutil;
            $slide->flag_slide = 1;
            $slide->type_fichier = 'FI';
            $slide->libelle_bouton_slide = $data['libelle_bouton_slide'];
            $slide->lien_bouton_slide = $data['lien_bouton_slide'];

            if (isset($data['slide'])){

            $filefront = $data['slide'];

            $fileName1 = 'slide'. '_' . rand(111,99999) . '_' . 'slide' . '_' . time() . '.' . $filefront->extension();

            $filefront->move(public_path('frontend/slide/'), $fileName1);

            $slide->image_slide = $fileName1;
            }

            $slide->save();

            return redirect('/slides')->with('success','enregistrement effectué');

        }

        return view('slide.creer');
    }

    public function creationslidevideo(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $slide = new Slide;

            $slide->titre_slide = $data['titre_slide'];
            $slide->description_slide = $data['description_slide'];
            $slide->id_user = $idutil;
            $slide->flag_slide = 1;
            $slide->type_fichier = 'FV';
            $slide->libelle_bouton_slide = $data['libelle_bouton_slide'];
            $slide->lien_bouton_slide = $data['lien_bouton_slide'];

            /*if (isset($data['slide'])){

                $filefront = $data['slide'];

                $fileName1 = 'slide'. '_' . rand(111,99999) . '_' . 'slide' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/slide/'), $fileName1);

                $slide->image_slide = $fileName1;
            }*/

            if (isset($data['slide'])){

                $res1 = explode("/", $data['slide']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                $slide->image_slide = $res;

            }

            $slide->save();

            return redirect('/slides')->with('success','enregistrement effectué');

        }

        return view('slide.creerv');
    }

    public function modifierslides(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $slide = DB::table('slide')->where([['id_slide','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Slide::where([['id_slide','=',$id]])->update(['titre_slide' =>$data['titre_slide'],'description_slide' =>$data['description_slide'],'id_user' =>$idutil,'libelle_bouton_slide' =>$data['libelle_bouton_slide'],'lien_bouton_slide' =>$data['lien_bouton_slide']]);

            return redirect('/slides')->with('success','modification effectué');
        }

        return view('slide.modifier',compact('slide','id'));
    }

    public function activeslide($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Slide::where([['id_slide','=',$id]])->update(['flag_slide' => 1]);

        return redirect('/slides')->with('success','modification effectué');

    }

    public function desactiveslide($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Slide::where([['id_slide','=',$id]])->update(['flag_slide' => 0]);

        return redirect('/slides')->with('success','modification effectué');
    }

    public function productservice(){

        $produits = DB::table('produit')->get();

        return view('produit.index',compact('produits'));
    }

    public function creerproductservice(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $produit = new Produit;

            $produit->titre_produit = $data['titre_produit'];
            $produit->id_cat_produit = $data['id_cat_produit'];
            $produit->lien_produit = $data['lien_produit'];
            $produit->description_produit = $data['description_produit'];
            $produit->id_user = $idutil;
            $produit->flag_produit = 1;

            if (isset($data['image'])){

                $filefront = $data['image'];

                $fileName1 = 'produitimage'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produit/image/'), $fileName1);

                $produit->image_produit = $fileName1;

            }

            if (isset($data['icon'])){

                $filefront1 = $data['icon'];

                $fileName2 = 'produiticon'. '_' . rand(111,99999) . '_' . 'produit' . '_' . time() . '.' . $filefront1->extension();

                $filefront1->move(public_path('frontend/produit/icon/'), $fileName2);

                $produit->icon_produit = $fileName2;

            }


            $produit->save();

            return redirect('/productservice')->with('success','enregistrement effectué');

        }

        $categoriesprods =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesprods as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produit.creer',compact('categoriesact'));
    }

    public function modifierproductservice(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $produit = DB::table('produit')->where([['id_produit','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Produit::where([['id_produit','=',$id]])->update(['titre_produit' =>$data['titre_produit'],'description_produit' =>$data['description_produit'],
                                                                'id_user' =>$idutil,'id_cat_produit' =>$data['id_cat_produit'],'lien_produit' =>$data['lien_produit']]);

            return redirect('/productservice')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_produit')->where([['id_cat_prod','=',$produit->id_cat_produit]])->first();

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_cat_prod . "'>" . $categoriesactss->libelle_cat_prod . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produit.modifier',compact('produit','id','categoriesact'));
    }

    public function activeproductservice($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit' => 1]);

        return redirect('/productservice')->with('success','modification effectué');

    }

    public function desactiveproductservice($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit' => 0]);

        return redirect('/productservice')->with('success','modification effectué');
    }



    public function actualite(){

        $actualites = DB::table('actualite')->join('categorie_activite','actualite.id_cat','categorie_activite.id_categ')->get();

        return view('actualite.index',compact('actualites'));
    }

    public function creationactualite(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $actualite = new Actualite;

            $actualite->titre_actualite = $data['titre_actualite'];
            $actualite->description_actualite = $data['description_actualite'];
            $actualite->id_user = $idutil;
            $actualite->flag_actualite = 1;
            $actualite->id_cat = $data['id_cat'];
            $actualite->lien_text_actu = $data['lien_text_actu'];
            $actualite->date_pub_actu = $data['date_pub_actu'];

            if (isset($data['image_actualite'])){

                $filefront = $data['image_actualite'];

                $fileName1 = 'actualite'. '_' . rand(111,99999) . '_' . 'actualite' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/actualite/'), $fileName1);

                $actualite->image_actualite = $fileName1;
            }

            $actualite->save();

            return redirect('/actualite')->with('success','enregistrement effectué');

        }

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_activite c where c.flag_categ = true order by c.id_categ '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_categ . "'>" . $comp->lib_categ . "</option>";
        }

        return view('actualite.creer',compact('categoriesact'));
    }

    public function modifieractualite(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $actualite = DB::table('actualite')->where([['id_actualite','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Actualite::where([['id_actualite','=',$id]])->update(['titre_actualite' =>$data['titre_actualite'],'description_actualite' =>$data['description_actualite'],
                'id_user' =>$idutil, 'lien_text_actu' => $data['lien_text_actu'], 'date_pub_actu' => $data['date_pub_actu']]);

            return redirect('/actualite')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_activite')->where([['id_categ','=',$actualite->id_cat]])->first();

        $categoriesacts =  DB::select(DB::raw('select  * from categorie_activite c where c.flag_categ = true order by c.id_categ '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_categ . "'>" . $categoriesactss->lib_categ . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_categ . "'>" . $comp->lib_categ . "</option>";
        }

        return view('actualite.modifier',compact('actualite','id','categoriesact'));
    }

    public function activeactualite($id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Actualite::where([['id_actualite','=',$id]])->update(['flag_actualite' => 1]);

        return redirect('/actualite')->with('success','modification effectué');

    }

    public function desactiveactualite($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Actualite::where([['id_actualite','=',$id]])->update(['flag_actualite' => 0]);

        return redirect('/actualite')->with('success','modification effectué');
    }


    public function produitphare(){

        $produit_phares = DB::table('produit_phare')->get();

        return view('produitphare.index',compact('produit_phares'));
    }

    public function creerproduitphare(Request $request){

        $idutil = Auth::user()->id;

        $nombre =DB::table('produit_phare')->where([['flag_prod_ph','=',1]])->get();

        $nbre = count($nombre);


        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $produit = new ProduitPhare;

            $produit->titre_prod_ph = $data['titre_prod_ph'];
            $produit->description_prod_ph = $data['description_prod_ph'];
            $produit->id_cat_prod = $data['id_cat_prod'];
            $produit->lien_produit_phare = $data['lien_produit_phare'];
            $produit->id_user = $idutil;
            if ($nbre == 3){
                $produit->flag_prod_ph = 0;
            }else{
                $produit->flag_prod_ph = 1;
            }


            if (isset($data['image_prod_ph'])){

                $filefront = $data['image_prod_ph'];

                $fileName1 = 'produitphare'. '_' . rand(111,99999) . '_' . 'produitphare' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/produitphare/'), $fileName1);

                $produit->image_prod_ph = $fileName1;

            }

            if (isset($data['video_prod_ph'])){

                $res1 = explode("/", $data['video_prod_ph']);
                $res = 'https://www.youtube.com/embed/' . $res1[3];

                $produit->video_prod_ph = $res;

            }


            $produit->save();

            return redirect('/produitphare')->with('success','enregistrement effectué');

        }

        $categoriesprods =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option selected > Selectionner une categorie :</option>";
        foreach ($categoriesprods as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produitphare.creer', compact('categoriesact'));
    }

    public function modifierproduitphare(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $produit = DB::table('produit_phare')->where([['id_prod_ph','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            ProduitPhare::where([['id_prod_ph','=',$id]])->update(['titre_prod_ph' =>$data['titre_prod_ph'],'description_prod_ph' =>$data['description_prod_ph'],'id_user' =>$idutil]);

            return redirect('/produitphare')->with('success','modification effectué');
        }

        $categoriesactss = DB::table('categorie_produit')->where([['id_cat_prod','=',$produit->id_cat_prod]])->first();
//dd($categoriesactss);
        $categoriesacts =  DB::select(DB::raw('select  * from categorie_produit c where c.flag_cat_prod = true order by c.id_cat_prod '),

        );
        // $clients = Client::where([['flag_prospect_cli', '=', 1]])->get();
        $categoriesact = "<option value='" . $categoriesactss->id_cat_prod . "'>" . $categoriesactss->libelle_cat_prod . "</option>";
        foreach ($categoriesacts as $comp) {
            $categoriesact .= "<option value='" . $comp->id_cat_prod . "'>" . $comp->libelle_cat_prod . "</option>";
        }

        return view('produitphare.modifier',compact('produit','id', 'categoriesact'));
    }

    public function activeproduitphare($id=null){

       /* $nombre =DB::table('produit_phare')->where([['flag_prod_ph','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 3){
            return redirect('/produitphare')->with('errors','Vous ne pouvez pas activer plus de trois produits phare');
        }else{
            ProduitPhare::where([['id_prod_ph','=',$id]])->update(['flag_prod_ph' => 1]);

            return redirect('/produitphare')->with('success','modification effectué');
        }*/

        $nombre =DB::table('produit')->where([['flag_produit_phare','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 3){
            return redirect('/productservice')->with('errors','Vous ne pouvez pas activer plus de trois produits phare');
        }else{
            Produit::where([['id_produit','=',$id]])->update(['flag_produit_phare' => 1]);

            return redirect('/productservice')->with('success','modification effectué');
        }


    }

    public function desactiveproduitphare($id=null){

       /* $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        ProduitPhare::where([['id_prod_ph','=',$id]])->update(['flag_prod_ph' => 0]);

        return redirect('/produitphare')->with('success','modification effectué');*/

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Produit::where([['id_produit','=',$id]])->update(['flag_produit_phare' => 0]);

        return redirect('/productservice')->with('success','modification effectué');
    }



    public function temoignanges(){

        $temoignanges = DB::table('temoignange')->get();

        return view('temoignanges.index',compact('temoignanges'));
    }

    public function creertemoignanges(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $temoignange = new Temoignange;

            $temoignange->message_temoin = $data['message_temoin'];
            $temoignange->id_user = $idutil;
            $temoignange->flag_temoi = 1;
            $temoignange->nom_prenom = $data['nom_prenom'];

            if (isset($data['image_temoi'])){

                $filefront = $data['image_temoi'];

                $fileName1 = 'temoignange'. '_' . rand(111,99999) . '_' . 'temoignange' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/temoignange/'), $fileName1);

                $temoignange->image_temoi = $fileName1;

            }


            $temoignange->save();

            return redirect('/temoignanges')->with('success','enregistrement effectué');

        }

        return view('temoignanges.creer');
    }

    public function modifiertemoignanges(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $temoignange = DB::table('temoignange')->where([['id_temoi','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Temoignange::where([['id_temoi','=',$id]])->update(['message_temoin' =>$data['message_temoin'],'nom_prenom' =>$data['nom_prenom'],'id_user' =>$idutil]);

            return redirect('/temoignanges')->with('success','modification effectué');
        }

        return view('temoignanges.modifier',compact('temoignange','id'));
    }

    public function activetemoignanges($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Temoignange::where([['id_temoi','=',$id]])->update(['flag_temoi' => 1]);

        return redirect('/temoignanges')->with('success','modification effectué');

    }

    public function desactivetemoignanges($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Temoignange::where([['id_temoi','=',$id]])->update(['flag_temoi' => 0]);

        return redirect('/temoignanges')->with('success','modification effectué');
    }

    public function categorieactivite(){

        $categorieactivites = DB::table('categorie_activite')->get();

        return view('categorieactivites.index',compact('categorieactivites'));
    }

    public function creercategorieactivite(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categorieactivit = new CategorieActivite;

            $categorieactivit->lib_categ = $data['lib_categ'];
            $categorieactivit->id_user = $idutil;
            $categorieactivit->flag_categ = 1;


            $categorieactivit->save();

            return redirect('/categorieactivite')->with('success','enregistrement effectué');

        }

        return view('categorieactivites.creer');
    }

    public function modifiercategorieactivite(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categorieactivite = DB::table('categorie_activite')->where([['id_categ','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieActivite::where([['id_categ','=',$id]])->update(['lib_categ' =>$data['lib_categ'],'id_user' =>$idutil]);

            return redirect('/categorieactivite')->with('success','modification effectué');
        }

        return view('categorieactivites.modifier',compact('categorieactivite','id'));
    }

    public function activecategorieactivite($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieActivite::where([['id_categ','=',$id]])->update(['flag_categ' => 1]);

        return redirect('/categorieactivite')->with('success','modification effectué');

    }

    public function desactivecategorieactivite($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieActivite::where([['id_categ','=',$id]])->update(['flag_categ' => 0]);

        return redirect('/categorieactivite')->with('success','modification effectué');
    }

    public function gestionpage(){

        $gestiondepages = DB::table('gestion_page')->get();

        return view('gestiondepages.index',compact('gestiondepages'));
    }

    public function creergestiondepage(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $gestionpage = new GestionPage;

            $gestionpage->nom_tech_gest_page = $data['nom_tech_gest_page'];
            $gestionpage->nom_pub_gest_page = $data['nom_pub_gest_page'];
            $gestionpage->descrp_gest_page = $data['descrp_gest_page'];
            $gestionpage->ordre_gest_page = $data['ordre_gest_page'];
            $gestionpage->id_user = $idutil;
            $gestionpage->flag_gest_page = 1;


            $gestionpage->save();

            return redirect('/gestionpage')->with('success','enregistrement effectué');

        }

        return view('gestiondepages.creer');
    }

    public function modifiergestiondepage(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestiondepage = DB::table('gestion_page')->where([['id_gest_page','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            GestionPage::where([['id_gest_page','=',$id]])->update(['nom_tech_gest_page' =>$data['nom_tech_gest_page'],
                                                                    'nom_pub_gest_page' =>$data['nom_pub_gest_page'],
                                                                    'descrp_gest_page' =>$data['descrp_gest_page'],
                                                                    'ordre_gest_page' =>$data['ordre_gest_page'],
                                                                    'id_user' =>$idutil]);

            return redirect('/gestionpage')->with('success','modification effectué');
        }

        return view('gestiondepages.modifier',compact('gestiondepage','id'));
    }

    public function activegestiondepage($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPage::where([['id_gest_page','=',$id]])->update(['flag_gest_page' => 1]);

        return redirect('/gestionpage')->with('success','modification effectué');

    }

    public function desactivegestiondepage($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPage::where([['id_gest_page','=',$id]])->update(['flag_gest_page' => 0]);

        return redirect('/gestionpage')->with('success','modification effectué');
    }


    public function gestionbloc(){

        $gestiondeblocs = DB::table('gestion_bloc')->join('gestion_page','gestion_bloc.id_gestion_page','gestion_page.id_gest_page')->get();

        return view('gestiondeblocs.index',compact('gestiondeblocs'));
    }

    public function creergestiondebloc(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

           // dd($data);die();

            $gestionbloc = new GestionBloc;

            $gestionbloc->id_gestion_page = $data['id_gestion_page'];
            $gestionbloc->nom_tech_gest_bloc = $data['nom_tech_gest_bloc'];
            $gestionbloc->nom_pub_gest_bloc = $data['nom_pub_gest_bloc'];
            $gestionbloc->descrp_gest_bloc = $data['descrp_gest_bloc'];
            $gestionbloc->ordre_gest_bloc = $data['ordre_gest_bloc'];
            $gestionbloc->bloc_parent = $data['bloc_parent'];
            $gestionbloc->id_user = $idutil;
            $gestionbloc->flag_bloc = 1;


            $gestionbloc->save();

            return redirect('/gestionbloc')->with('success','enregistrement effectué');

        }

        $gestionpages = GestionPage::where([['flag_gest_page','=',true]])->get();

        $gestionpage = "<option> Selection une page </option>";
        foreach ($gestionpages as $comp) {
            $gestionpage .= "<option value='" . $comp->id_gest_page . "'>" . $comp->nom_tech_gest_page . '/' . $comp->nom_pub_gest_page ."</option>";
        }

        return view('gestiondeblocs.creer',compact('gestionpage'));
    }

    public function modifiergestiondebloc(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestiondebloc = DB::table('gestion_bloc')->where([['id_gest_bloc','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            GestionBloc::where([['id_gest_bloc','=',$id]])->update(['nom_tech_gest_bloc' =>$data['nom_tech_gest_bloc'],
                'id_gestion_page' => $data['id_gestion_page'],
                'nom_pub_gest_bloc' =>$data['nom_pub_gest_bloc'],
                'descrp_gest_bloc' =>$data['descrp_gest_bloc'],
                'ordre_gest_bloc' =>$data['ordre_gest_bloc'],
                'bloc_parent' =>$data['bloc_parent'],
                'id_user' =>$idutil]);

            return redirect('/gestionbloc')->with('success','modification effectué');
        }

        $gestionpagess = GestionPage::where([['id_gest_page','=',$gestiondebloc->id_gestion_page]])->first();

        $gestionpages = GestionPage::where([['flag_gest_page','=',true]])->get();

        $gestionpage = "<option value='" . $gestionpagess->id_gest_page . "'>" . $gestionpagess->nom_tech_gest_page . '/' . $gestionpagess->nom_pub_gest_page ."</option>";
        foreach ($gestionpages as $comp) {
            $gestionpage .= "<option value='" . $comp->id_gest_page . "'>" . $comp->nom_tech_gest_page . '/' . $comp->nom_pub_gest_page ."</option>";
        }

        return view('gestiondeblocs.modifier',compact('gestiondebloc','id','gestionpage'));
    }

    public function activegestiondebloc($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionBloc::where([['id_gest_bloc','=',$id]])->update(['flag_bloc' => 1]);

        return redirect('/gestionbloc')->with('success','modification effectué');

    }

    public function desactivegestiondebloc($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionBloc::where([['id_gest_bloc','=',$id]])->update(['flag_bloc' => 0]);

        return redirect('/gestionbloc')->with('success','modification effectué');
    }

    public function gestionpersonnel(){

        $gestionpersonnels = DB::table('gestion_personnel')->get();

        return view('gestionpersonnels.index',compact('gestionpersonnels'));
    }

    public function creergestionpersonnels(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $gestpersonnel = new GestionPersonnel;

            $gestpersonnel->nom_gest_pers = $data['nom_gest_pers'];
            $gestpersonnel->fonc_gest_pers = $data['fonc_gest_pers'];
            $gestpersonnel->desc_gest_pers = $data['desc_gest_pers'];
            $gestpersonnel->id_user = $idutil;
            $gestpersonnel->flag_gest_pers = 1;
            $gestpersonnel->ordre_gest_pers = $data['ordre_gest_pers'];

            if (isset($data['image_gest_pers'])){

                $filefront = $data['image_gest_pers'];

                $fileName1 = 'gestion_personnel'. '_' . rand(111,99999) . '_' . 'gestion_personnel' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/gestionpersonnel/'), $fileName1);

                $gestpersonnel->image_gest_pers = $fileName1;

            }


            $gestpersonnel->save();

            return redirect('/gestionpersonnel')->with('success','enregistrement effectué');

        }

        return view('gestionpersonnels.creer');
    }

    public function modifiergestionpersonnels(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $gestionpersonnel = DB::table('gestion_personnel')->where([['id_gest_pers','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['nom_gest_pers' =>$data['nom_gest_pers'],
                'id_user' =>$idutil, 'fonc_gest_pers' => $data['fonc_gest_pers'], 'desc_gest_pers' => $data['desc_gest_pers'],
                'ordre_gest_pers' => $data['ordre_gest_pers']]);

            return redirect('/gestionpersonnel')->with('success','modification effectué');
        }

        return view('gestionpersonnels.modifier',compact('gestionpersonnel','id'));
    }

    public function activegestionpersonnels($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['flag_gest_pers' => 1]);

        return redirect('/gestionpersonnel')->with('success','modification effectué');

    }

    public function desactivegestionpersonnels($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        GestionPersonnel::where([['id_gest_pers','=',$id]])->update(['flag_gest_pers' => 0]);

        return redirect('/gestionpersonnel')->with('success','modification effectué');
    }

    public function menufront(Request $request)
    {

        $data = MenuFront::all();


        return view('menu_front.index',compact('data'));
    }

    public function creermenufront(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $menuf = new MenuFront;

            $menuf->nenu_front = $data['nenu_front'];
            $menuf->priorite_menu_front = $data['priorite_menu_front'];

            $menuf->save();

            return redirect('/menufront')->with('success','enregistrement effectué');

        }

        return view('menu_front.create');
    }

    public function modifiermenufront(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $menu = DB::table('menu_front')->where([['id_menu_front','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            MenuFront::where([['id_menu_front','=',$id]])->update(['nenu_front' =>$data['nenu_front'], 'priorite_menu_front' => $data['priorite_menu_front']]);

            return redirect('/menufront')->with('success','modification effectué');
        }

        return view('menu_front.edit',compact('menu','id'));
    }

    public function menufronthaut(Request $request)
    {

        $data = DB::table('sous_menu_front')->join('menu_front','sous_menu_front.menu_front_id_menu_front','menu_front.id_menu_front')->get();


        return view('sousmenus_front.index',compact('data'));
    }

    public function creermenufronthaut(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $menusf = new SousMenuFront;

            $menusf->menu_front_id_menu_front = $data['menu_front_id_menu_front'];
            $menusf->libelle_sous_menu_front = $data['libelle_sous_menu_front'];
            $menusf->priorite_sous_menu_front = $data['priorite_sous_menu_front'];
            $menusf->sous_menu_front = $data['sous_menu_front'];

            $menusf->save();

            return redirect('/menufronthaut')->with('success','enregistrement effectué');

        }

        $menuss = MenuFront::get();

        /*$stocks = Stock::where(['flag_statut'=>1])->orderby('created_at','DESC')->get();*/


        $menus = "<option selected disabled>Select</option>";
        foreach ($menuss as $comp ) {
            $menus .= "<option value='".$comp->id_menu_front."'>".$comp->nenu_front."</option>";
        }

        return view('sousmenus_front.create',compact('menus'));
    }

    public function modifiermenufronthaut(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $sousmenus = DB::table('sous_menu_front')->where([['id_sous_menu_front','=',$id]])->first();
//dd($sousmenus);
        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            SousMenuFront::where([['id_sous_menu_front','=',$id]])->update(['menu_front_id_menu_front' =>$data['menu_front_id_menu_front'], 'libelle_sous_menu_front' => $data['libelle_sous_menu_front'],
                'priorite_sous_menu_front' =>$data['priorite_sous_menu_front'], 'sous_menu_front' => $data['sous_menu_front']]);

            return redirect('/menufronthaut')->with('success','modification effectué');
        }

        $menusss = MenuFront::where([['id_menu_front','=',$sousmenus->menu_front_id_menu_front]])->first();

        $menuss = MenuFront::get();

        $menus = "<option value='".$menusss->id_menu_front."'>".$menusss->nenu_front."</option>";
        foreach ($menuss as $comp ) {
            $menus .= "<option value='".$comp->id_menu_front."'>".$comp->nenu_front."</option>";
        }

        return view('sousmenus_front.edit',compact('sousmenus','id','menus'));
    }


    public function partenaire(){

        $partenaires = DB::table('partenaire')->get();

        return view('partenaires.index',compact('partenaires'));
    }

    public function creerpartenaire(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $partenaire = new Partenaire;

            $partenaire->titre_part = $data['titre_part'];
            $partenaire->id_user = $idutil;
            $partenaire->flag_part = 1;

            if (isset($data['logo_part'])){

                $filefront = $data['logo_part'];

                $fileName1 = 'logo_part'. '_' . rand(111,99999) . '_' . 'logo_part' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/logopart/'), $fileName1);

                $partenaire->logo_part = $fileName1;

            }

            $partenaire->save();

            return redirect('/partenaire')->with('success','enregistrement effectué');

        }

        return view('partenaires.creer');
    }

    public function modifierpartenaire(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $partenaire = DB::table('partenaire')->where([['id_parte','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Partenaire::where([['id_parte','=',$id]])->update(['titre_part' =>$data['titre_part'],'id_user' =>$idutil]);

            return redirect('/partenaire')->with('success','modification effectué');
        }

        return view('partenaires.modifier',compact('partenaire','id'));
    }

    public function activepartenaire($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Partenaire::where([['id_parte','=',$id]])->update(['flag_part' => 1]);

        return redirect('/partenaire')->with('success','modification effectué');

    }

    public function desactivepartenaire($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Partenaire::where([['id_parte','=',$id]])->update(['flag_part' => 0]);

        return redirect('/partenaire')->with('success','modification effectué');
    }

    public function categorieproduit(){

        $categorieproduits = DB::table('categorie_produit')->get();

        return view('categorieproduits.index',compact('categorieproduits'));
    }

    public function creercategorieproduit(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $categorieprodui = new CategorieProduit;

            $categorieprodui->libelle_cat_prod = $data['libelle_cat_prod'];
            $categorieprodui->id_user = $idutil;
            $categorieprodui->flag_cat_prod = 1;


            $categorieprodui->save();

            return redirect('/categorieproduit')->with('success','enregistrement effectué');

        }

        return view('categorieproduits.creer');
    }

    public function modifiercategorieproduit(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $categorieproduit = DB::table('categorie_produit')->where([['id_cat_prod','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            CategorieProduit::where([['id_cat_prod','=',$id]])->update(['libelle_cat_prod' =>$data['libelle_cat_prod'],'id_user' =>$idutil]);

            return redirect('/categorieproduit')->with('success','modification effectué');
        }

        return view('categorieproduits.modifier',compact('categorieproduit','id'));
    }

    public function activecategorieproduit($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        CategorieProduit::where([['id_cat_prod','=',$id]])->update(['flag_cat_prod' => 1]);

        return redirect('/categorieproduit')->with('success','modification effectué');

    }

    public function desactivecategorieproduit($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        CategorieProduit::where([['id_cat_prod','=',$id]])->update(['flag_cat_prod' => 0]);

        return redirect('/categorieproduit')->with('success','modification effectué');
    }

    public function statistique(){

        $statistiques = DB::table('statistique')->get();

        return view('statistiques.index',compact('statistiques'));
    }

    public function creerstatistique(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $statistique = new Statistique;

            $statistique->libelle_stat = $data['libelle_stat'];
            $statistique->stat_stat = $data['stat_stat'];
            $statistique->id_user = $idutil;
            $statistique->flag_stat = 1;
            $statistique->text_icon = $data['text_icon'];

            if (isset($data['icon_stat'])){

                $filefront = $data['icon_stat'];

                $fileName1 = 'icon_stat'. '_' . rand(111,99999) . '_' . 'icon_stat' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/iconstat/'), $fileName1);

                $statistique->icon_stat = $fileName1;

            }


            $statistique->save();

            return redirect('/statistique')->with('success','enregistrement effectué');

        }

        return view('statistiques.creer');
    }

    public function modifierstatistique(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $statistique = DB::table('statistique')->where([['id_stat','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Statistique::where([['id_stat','=',$id]])->update([
                'libelle_stat' =>$data['libelle_stat'],'id_user' =>$idutil,
                'stat_stat' =>$data['stat_stat'],'text_icon' =>$data['text_icon']
            ]);

            return redirect('/statistique')->with('success','modification effectué');
        }

        return view('statistiques.modifier',compact('statistique','id'));
    }

    public function activestatistique($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        Statistique::where([['id_stat','=',$id]])->update(['flag_stat' => 1]);

        return redirect('/statistique')->with('success','modification effectué');

    }

    public function desactivstatistique($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Statistique::where([['id_stat','=',$id]])->update(['flag_stat' => 0]);

        return redirect('/statistique')->with('success','modification effectué');
    }

    public function logo(){

        $logos = DB::table('logo')->get();

        return view('logos.index',compact('logos'));
    }

    public function creerlogo(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $nombre =DB::table('logo')->where([['flag_logo','=',1]])->get();

            $nbre = count($nombre);


            $logo = new Logo;

            $logo->titre_logo = $data['titre_logo'];
            if ($nbre == 1){
                $logo->flag_logo = 0;
            }else{
                $logo->flag_logo = 1;
            }

            $logo->id_user = $idutil;

            if (isset($data['logo_logo'])){

                $filefront = $data['logo_logo'];

                $fileName1 = 'logo_logo'. '_' . rand(111,99999) . '_' . 'logo_logo' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/logo/'), $fileName1);

                $logo->logo_logo = $fileName1;

            }


            $logo->save();

            return redirect('/logo')->with('success','enregistrement effectué');

        }

        return view('logos.creer');
    }

    public function modifierlogo(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $logo = DB::table('logo')->where([['id_logo','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Logo::where([['id_logo','=',$id]])->update([
                'titre_logo' =>$data['titre_logo'],'id_user' =>$idutil
            ]);

            return redirect('/logo')->with('success','modification effectué');
        }

        return view('logos.modifier',compact('logo','id'));
    }

    public function activelogo($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        $nombre =DB::table('logo')->where([['flag_logo','=',1]])->get();

        $nbre = count($nombre);


        if ($nbre == 1){
            return redirect('/logo')->with('errors','Vous ne pouvez pas activer plus d un conseil regional');
        }else{
            Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 1]);

            return redirect('/logo')->with('success','modification effectué');
        }
        //exit('tes');


    }

    public function desactivelogo($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Logo::where([['id_logo','=',$id]])->update(['flag_logo' => 0]);

        return redirect('/logo')->with('success','modification effectué');
    }

    public function banner(){

        $banners = DB::table('banner')->get();

        return view('banners.index',compact('banners'));
    }

    public function creerbanner(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $nombre =DB::table('banner')->where([['flag_banner','=',1]])->get();

            $nbre = count($nombre);


            $banner = new Banner;

            $banner->titre_banner = $data['titre_banner'];
            if ($nbre == 1){
                $banner->flag_banner = 0;
            }else{
                $banner->flag_banner = 1;
            }

            $banner->id_user = $idutil;

            if (isset($data['image_banner'])){

                $filefront = $data['image_banner'];

                $fileName1 = 'image_banner'. '_' . rand(111,99999) . '_' . 'image_banner' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/banner/'), $fileName1);

                $banner->image_banner = $fileName1;

            }


            $banner->save();

            return redirect('/banner')->with('success','enregistrement effectué');

        }

        return view('banners.creer');
    }

    public function modifierbanner(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $banner = DB::table('banner')->where([['id_banner','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Banner::where([['id_banner','=',$id]])->update([
                'titre_banner' =>$data['titre_banner'],'id_user' =>$idutil
            ]);

            return redirect('/banner')->with('success','modification effectué');
        }

        return view('banners.modifier',compact('banner','id'));
    }

    public function activebanner($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        $nombre =DB::table('banner')->where([['flag_banner','=',1]])->get();

        $nbre = count($nombre);


        if ($nbre == 1){
            return redirect('/banner')->with('errors','Vous ne pouvez pas activer plus d un conseil regional');
        }else{
            Banner::where([['id_banner','=',$id]])->update(['flag_banner' => 1]);

            return redirect('/banner')->with('success','modification effectué');
        }
        //exit('tes');


    }

    public function desactivebanner($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Banner::where([['id_banner','=',$id]])->update(['flag_banner' => 0]);

        return redirect('/banner')->with('success','modification effectué');
    }


    public function personnel(){

        $personnels = DB::table('personnel')->get();

        return view('personnels.index',compact('personnels'));
    }

    public function creerpersonnel(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $personnel = new Personnel;

            $personnel->nom_personnel = $data['nom_personnel'];
            $personnel->prenom_personnel = $data['prenom_personnel'];
            $personnel->fonction_personnel = $data['fonction_personnel'];
            $personnel->mot_personnel = $data['mot_personnel'];
            $personnel->id_user = $idutil;
            $personnel->date_debut_fonction = new \DateTime($data['date_debut_fonction']);
            $personnel->flag_personnel = 1;

            if (isset($data['image_personnel'])){

                $filefront = $data['image_personnel'];

                $fileName1 = 'image_personnel'. '_' . rand(111,99999) . '_' . 'image_personnel' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/imagepersonnel/'), $fileName1);

                $personnel->image_personnel = $fileName1;

            }


            $personnel->save();

            return redirect('/personnel')->with('success','enregistrement effectué');

        }

        return view('personnels.creer');
    }

    public function modifierpersonnel(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $personnel = DB::table('personnel')->where([['id_personnel','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Personnel::where([['id_personnel','=',$id]])->update([
                'nom_personnel' =>$data['nom_personnel'],'id_user' =>$idutil,
                'prenom_personnel' =>$data['prenom_personnel'],'fonction_personnel' =>$data['fonction_personnel'],
                'mot_personnel' =>$data['mot_personnel'],'date_debut_fonction' =>$data['date_debut_fonction'],
                'date_fin_fonction' =>$data['date_fin_fonction']
            ]);

            return redirect('/personnel')->with('success','modification effectué');
        }

        return view('personnels.modifier',compact('personnel','id'));
    }

    public function activepersonnel($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        //exit('tes');
        Personnel::where([['id_personnel','=',$id]])->update(['flag_personnel' => 1]);

        return redirect('/personnel')->with('success','modification effectué');

    }

    public function desactivepersonnel($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Personnel::where([['id_personnel','=',$id]])->update(['flag_personnel' => 0]);

        return redirect('/personnel')->with('success','modification effectué');
    }

    public function activepersonnelres($id=null){

        $nombre =DB::table('personnel')->where([['flag_actif_responsable','=',1]])->get();

        $nbre = count($nombre);

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        if ($nbre == 1){
            return redirect('/personnel')->with('errors','Vous ne pouvez pas activer plus d un conseil regional');
        }else{
            Personnel::where([['id_personnel','=',$id]])->update(['flag_actif_responsable' => 1]);

            return redirect('/personnel')->with('success','modification effectué');
        }


    }

    public function desactivepersonnelres($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Personnel::where([['id_personnel','=',$id]])->update(['flag_actif_responsable' => 0]);

        return redirect('/personnel')->with('success','modification effectué');
    }

    public function help(){

        $helps = DB::table('help')->get();

        return view('helps.index',compact('helps'));
    }

    public function creerhelp(Request $request){

        $idutil = Auth::user()->id;

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            $help = new Help();

            $help->nom_prenom_help = $data['nom_prenom_help'];
            $help->fonction_help = $data['fonction_help'];
            $help->description_help = $data['description_help'];
            $help->flag_help = 1;
            $help->id_user = $idutil;


            if (isset($data['photo_help'])){

                $filefront = $data['photo_help'];

                $fileName1 = 'photo_help'. '_' . rand(111,99999) . '_' . 'photo_help' . '_' . time() . '.' . $filefront->extension();

                $filefront->move(public_path('frontend/help/'), $fileName1);

                $help->photo_help = $fileName1;

            }


            $help->save();

            return redirect('/help')->with('success','enregistrement effectué');

        }

        return view('helps.creer');
    }

    public function modifierhelp(Request $request, $id=null){


        $id =  \App\Helpers\Crypt::UrldeCrypt($id);
        $idutil = Auth::user()->id;

        $help = DB::table('help')->where([['id_help','=',$id]])->first();

        if ($request->isMethod('post')) {

            $data = $request->all();

            //dd($data);die();

            Help::where([['id_help','=',$id]])->update([
                'nom_prenom_help' =>$data['nom_prenom_help'],'id_user' =>$idutil,
                'fonction_help' =>$data['fonction_help'], 'description_help'  =>$data['description_help']
            ]);

            return redirect('/help')->with('success','modification effectué');
        }

        return view('helps.modifier',compact('help','id'));
    }

    public function activehelp($id=null){

        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

            Help::where([['id_help','=',$id]])->update(['flag_help' => 1]);

            return redirect('/help')->with('success','modification effectué');

    }

    public function desactivehelp($id=null){
        $id =  \App\Helpers\Crypt::UrldeCrypt($id);

        Help::where([['id_help','=',$id]])->update(['flag_help' => 0]);

        return redirect('/help')->with('success','modification effectué');
    }

}
