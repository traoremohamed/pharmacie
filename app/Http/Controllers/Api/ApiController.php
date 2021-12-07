<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Help;
use App\Models\Logo;
use App\Models\Partenaire;
use App\Models\Personnel;
use App\Models\Produit;
use App\Models\ProduitPhare;
use App\Models\Statistique;
use App\Models\Temoignange;
use DB;
use Illuminate\Http\Request;
use Log;
use App\Models\Slide;

class ApiController extends Controller
{
    public function getAllSlide(){
        $data = Slide::where([['flag_slide','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllTemoignange(){
        $data = Temoignange::where([['flag_temoi','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllActualite(){
        $data = DB::table('actualite')->join('categorie_activite','actualite.id_cat','categorie_activite.id_categ')->where([['actualite.flag_actualite','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllProduitE(){
        $data = DB::table('produit')->join('categorie_produit','produit.id_cat_produit','categorie_produit.id_cat_prod')->where([['flag_produit','=',true],['id_cat_produit','=',2]])->get(); //Produit::where([['flag_produit','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllProduitP(){
        $data = DB::table('produit')->join('categorie_produit','produit.id_cat_produit','categorie_produit.id_cat_prod')->where([['flag_produit','=',true],['id_cat_produit','=',1]])->get(); //Produit::where([['flag_produit','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllProduitPhare(){
        $data = Produit::where([['flag_produit_phare','=',true]])->get();

        return response()->json($data, 200);
    }



    public function getAllMenufront(){

        /*$resulat = DB::table('menu_front')->join('sous_menu_front','sous_menu_front.menu_front_id_menu_front','menu_front.id_menu_front')->orderby('sous_menu_front.priorite_sous_menu_front')->get();*/
        $resulat1 = DB::table('menu_front')->orderby('menu_front.priorite_menu_front')->get();
        $resulat2 = DB::table('menu_front')->join('sous_menu_front','sous_menu_front.menu_front_id_menu_front','menu_front.id_menu_front')->orderby('sous_menu_front.priorite_sous_menu_front')->get();

        // dd($resulat);
        //return response()->json($resulat, 200);
        $data = [];

        foreach ($resulat1 as $ligne) {

            $data[$ligne->id_menu_front][] = $ligne;

        }

        foreach ($resulat2 as $ligne) {

            $data[$ligne->id_menu_front]['sous_menu'] []= $ligne;

        }




        return response()->json($data, 200);
    }

    public function getAllPartenaire(){
        $data = Partenaire::where([['flag_part','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllHelp(){
        $data = Help::where([['flag_help','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllBanner(){
        $data = Banner::where([['flag_banner','=',true]])->first();

        return response()->json($data, 200);
    }

    public function getAllStatistique(){
        $data = Statistique::where([['flag_stat','=',true]])->get();

        return response()->json($data, 200);
    }

    public function getAllLogo(){
        $data = Logo::where([['flag_logo','=',true]])->first();

        return response()->json($data, 200);
    }

    public function getAllPersonnel(){
        $data = Personnel::where([['flag_personnel','=',true],['flag_actif_responsable','=',false]])->get();

        return response()->json($data, 200);
    }

    public function getAllPersonnelResp(){
        $data = Personnel::where([['flag_personnel','=',true],['flag_actif_responsable','=',true]])->first();

        return response()->json($data, 200);
    }
}
