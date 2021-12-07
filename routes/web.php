<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    //exit('test');
    return view('welcome');
});*/

Route::match(['get', 'post'], '/', [App\Http\Controllers\ConnexionController::class, 'login'])->name('connexion');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::match(['get', 'post'], '/login', [App\Http\Controllers\ConnexionController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/connexion', [App\Http\Controllers\ConnexionController::class, 'login'])->name('connexion');
Route::match(['get', 'post'], '/motdepasseoublie', [App\Http\Controllers\ConnexionController::class, 'motdepasseoublie'])->name('motdepasseoublie');
Route::get('/dashboard', [App\Http\Controllers\ConnexionController::class, 'dashboard'])->name('dashboard');
Route::get('/reload-captcha', [App\Http\Controllers\ConnexionController::class, 'reloadCaptcha'])->name('reloadCaptcha');


Route::group(['middleware' => ['auth']], function () {

    Route::resources([
        'roles' => App\Http\Controllers\RoleController::class,
        'users' => App\Http\Controllers\UserController::class,
        'products' => App\Http\Controllers\ProductController::class,
        'piece' => App\Http\Controllers\PieceController::class,
        'permissions' => App\Http\Controllers\PermissionController::class,
        'menus' => App\Http\Controllers\MenuController::class,
        'sousmenus' => App\Http\Controllers\SousmenuController::class,
    ]);

    Route::match(['get', 'post'], '/menuprofil', [App\Http\Controllers\GenerermenuController::class, 'parametragemenu'])->name('menuprofil');

    Route::match(['get', 'post'], '/compteclient/{id}', [App\Http\Controllers\UserController::class, 'compteclient'])->name('compteclient');


    Route::match(['get', 'post'], '/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');

    Route::match(['get', 'post'], '/modifiermotdepasse', [App\Http\Controllers\HomeController::class, 'updatepassword'])->name('modifier.mot.passe');

    Route::match(['get', 'post'], '/generermenu', [App\Http\Controllers\GenerermenuController::class, 'index'])->name('generermenu');

    Route::match(['get', 'post'], '/menuprofillayout/{id}', [App\Http\Controllers\GenerermenuController::class, 'menuprofillayout'])->name('menuprofillayout');

    Route::match(['get', 'post'], '/slides', [App\Http\Controllers\ParametrageController::class, 'slide'])->name('slides');

    Route::match(['get', 'post'], '/creerslides', [App\Http\Controllers\ParametrageController::class, 'creationslide'])->name('creerslides');

    Route::match(['get', 'post'], '/creerslidesv', [App\Http\Controllers\ParametrageController::class, 'creationslidevideo'])->name('creerslidesv');

    Route::match(['get', 'post'], '/modifierslides/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierslides'])->name('modifierslides');

    Route::match(['get', 'post'], '/activeslides/{id}', [App\Http\Controllers\ParametrageController::class, 'activeslide'])->name('activeslides');

    Route::match(['get', 'post'], '/desactiveslides/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveslide'])->name('desactiveslides');


    Route::match(['get', 'post'], '/productservice', [App\Http\Controllers\ParametrageController::class, 'productservice'])->name('productservice');

    Route::match(['get', 'post'], '/creerproductservice', [App\Http\Controllers\ParametrageController::class, 'creerproductservice'])->name('creerproductservice');

    Route::match(['get', 'post'], '/modifierproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierproductservice'])->name('modifierproductservice');

    Route::match(['get', 'post'], '/activeproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'activeproductservice'])->name('activeproductservice');

    Route::match(['get', 'post'], '/desactiveproductservice/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveproductservice'])->name('desactiveproductservice');


    Route::match(['get', 'post'], '/actualite', [App\Http\Controllers\ParametrageController::class, 'actualite'])->name('actualite');

    Route::match(['get', 'post'], '/creationactualite', [App\Http\Controllers\ParametrageController::class, 'creationactualite'])->name('creationactualite');

    Route::match(['get', 'post'], '/modifieractualite/{id}', [App\Http\Controllers\ParametrageController::class, 'modifieractualite'])->name('modifieractualite');

    Route::match(['get', 'post'], '/activeactualite/{id}', [App\Http\Controllers\ParametrageController::class, 'activeactualite'])->name('activeactualite');

    Route::match(['get', 'post'], '/desactiveactualite/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveactualite'])->name('desactiveactualite');


    Route::match(['get', 'post'], '/produitphare', [App\Http\Controllers\ParametrageController::class, 'produitphare'])->name('produitphare');

    Route::match(['get', 'post'], '/creerproduitphare', [App\Http\Controllers\ParametrageController::class, 'creerproduitphare'])->name('creerproduitphare');

    Route::match(['get', 'post'], '/modifierproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierproduitphare'])->name('modifierproduitphare');

    Route::match(['get', 'post'], '/activeproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'activeproduitphare'])->name('activeproduitphare');

    Route::match(['get', 'post'], '/desactiveproduitphare/{id}', [App\Http\Controllers\ParametrageController::class, 'desactiveproduitphare'])->name('desactiveproduitphare');


    Route::match(['get', 'post'], '/temoignanges', [App\Http\Controllers\ParametrageController::class, 'temoignanges'])->name('temoignanges');

    Route::match(['get', 'post'], '/creertemoignanges', [App\Http\Controllers\ParametrageController::class, 'creertemoignanges'])->name('creertemoignanges');

    Route::match(['get', 'post'], '/modifiertemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiertemoignanges'])->name('modifiertemoignanges');

    Route::match(['get', 'post'], '/activetemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'activetemoignanges'])->name('activetemoignanges');

    Route::match(['get', 'post'], '/desactivetemoignanges/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivetemoignanges'])->name('desactivetemoignanges');



    Route::match(['get', 'post'], '/categorieactivite', [App\Http\Controllers\ParametrageController::class, 'categorieactivite'])->name('categorieactivite');

    Route::match(['get', 'post'], '/creercategorieactivite', [App\Http\Controllers\ParametrageController::class, 'creercategorieactivite'])->name('creercategorieactivite');

    Route::match(['get', 'post'], '/modifiercategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategorieactivite'])->name('modifiercategorieactivite');

    Route::match(['get', 'post'], '/activecategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategorieactivite'])->name('activecategorieactivite');

    Route::match(['get', 'post'], '/desactivecategorieactivite/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategorieactivite'])->name('desactivecategorieactivite');


    Route::match(['get', 'post'], '/gestionpage', [App\Http\Controllers\ParametrageController::class, 'gestionpage'])->name('gestionpage');

    Route::match(['get', 'post'], '/creergestiondepage', [App\Http\Controllers\ParametrageController::class, 'creergestiondepage'])->name('creergestiondepage');

    Route::match(['get', 'post'], '/modifiergestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestiondepage'])->name('modifiergestiondepage');

    Route::match(['get', 'post'], '/activegestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestiondepage'])->name('activegestiondepage');

    Route::match(['get', 'post'], '/desactivegestiondepage/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestiondepage'])->name('desactivegestiondepage');


    Route::match(['get', 'post'], '/gestionbloc', [App\Http\Controllers\ParametrageController::class, 'gestionbloc'])->name('gestionbloc');

    Route::match(['get', 'post'], '/creergestiondebloc', [App\Http\Controllers\ParametrageController::class, 'creergestiondebloc'])->name('creergestiondebloc');

    Route::match(['get', 'post'], '/modifiergestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestiondebloc'])->name('modifiergestiondebloc');

    Route::match(['get', 'post'], '/activegestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestiondebloc'])->name('activegestiondebloc');

    Route::match(['get', 'post'], '/desactivegestiondebloc/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestiondebloc'])->name('desactivegestiondebloc');


    Route::match(['get', 'post'], '/gestionpersonnel', [App\Http\Controllers\ParametrageController::class, 'gestionpersonnel'])->name('gestionpersonnel');

    Route::match(['get', 'post'], '/creergestionpersonnels', [App\Http\Controllers\ParametrageController::class, 'creergestionpersonnels'])->name('creergestionpersonnels');

    Route::match(['get', 'post'], '/modifiergestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiergestionpersonnels'])->name('modifiergestionpersonnels');

    Route::match(['get', 'post'], '/activegestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'activegestionpersonnels'])->name('activegestionpersonnels');

    Route::match(['get', 'post'], '/desactivegestionpersonnels/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivegestionpersonnels'])->name('desactivegestionpersonnels');

    Route::match(['get', 'post'], '/menufront', [App\Http\Controllers\ParametrageController::class, 'menufront'])->name('menufront');

    Route::match(['get', 'post'], '/creermenufront', [App\Http\Controllers\ParametrageController::class, 'creermenufront'])->name('creermenufront');

    Route::match(['get', 'post'], '/modifiermenufront/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiermenufront'])->name('modifiermenufront');

    Route::match(['get', 'post'], '/menufronthaut', [App\Http\Controllers\ParametrageController::class, 'menufronthaut'])->name('menufronthaut');

    Route::match(['get', 'post'], '/creermenufronthaut', [App\Http\Controllers\ParametrageController::class, 'creermenufronthaut'])->name('creermenufronthaut');

    Route::match(['get', 'post'], '/modifiermenufronthaut/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiermenufronthaut'])->name('modifiermenufronthaut');


    Route::match(['get', 'post'], '/partenaire', [App\Http\Controllers\ParametrageController::class, 'partenaire'])->name('partenaire');

    Route::match(['get', 'post'], '/creerpartenaire', [App\Http\Controllers\ParametrageController::class, 'creerpartenaire'])->name('creerpartenaire');

    Route::match(['get', 'post'], '/modifierpartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierpartenaire'])->name('modifierpartenaire');

    Route::match(['get', 'post'], '/activepartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'activepartenaire'])->name('activepartenaire');

    Route::match(['get', 'post'], '/desactivepartenaire/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepartenaire'])->name('desactivepartenaire');

    Route::match(['get', 'post'], '/categorieproduit', [App\Http\Controllers\ParametrageController::class, 'categorieproduit'])->name('categorieproduit');

    Route::match(['get', 'post'], '/creercategorieproduit', [App\Http\Controllers\ParametrageController::class, 'creercategorieproduit'])->name('creercategorieproduit');

    Route::match(['get', 'post'], '/modifiercategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'modifiercategorieproduit'])->name('modifiercategorieproduit');

    Route::match(['get', 'post'], '/activecategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'activecategorieproduit'])->name('activecategorieproduit');

    Route::match(['get', 'post'], '/desactivecategorieproduit/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivecategorieproduit'])->name('desactivecategorieproduit');


    Route::match(['get', 'post'], '/statistique', [App\Http\Controllers\ParametrageController::class, 'statistique'])->name('statistique');

    Route::match(['get', 'post'], '/creerstatistique', [App\Http\Controllers\ParametrageController::class, 'creerstatistique'])->name('creerstatistique');

    Route::match(['get', 'post'], '/modifierstatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierstatistique'])->name('modifierstatistique');

    Route::match(['get', 'post'], '/activestatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'activestatistique'])->name('activestatistique');

    Route::match(['get', 'post'], '/desactivstatistique/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivstatistique'])->name('desactivstatistique');

    Route::match(['get', 'post'], '/logo', [App\Http\Controllers\ParametrageController::class, 'logo'])->name('logo');

    Route::match(['get', 'post'], '/creerlogo', [App\Http\Controllers\ParametrageController::class, 'creerlogo'])->name('creerlogo');

    Route::match(['get', 'post'], '/modifierlogo/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierlogo'])->name('modifierlogo');

    Route::match(['get', 'post'], '/activelogo/{id}', [App\Http\Controllers\ParametrageController::class, 'activelogo'])->name('activelogo');

    Route::match(['get', 'post'], '/desactivelogo/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivelogo'])->name('desactivelogo');

    Route::match(['get', 'post'], '/banner', [App\Http\Controllers\ParametrageController::class, 'banner'])->name('banner');

    Route::match(['get', 'post'], '/creerbanner', [App\Http\Controllers\ParametrageController::class, 'creerbanner'])->name('creerbanner');

    Route::match(['get', 'post'], '/modifierbanner/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierbanner'])->name('modifierbanner');

    Route::match(['get', 'post'], '/activebanner/{id}', [App\Http\Controllers\ParametrageController::class, 'activebanner'])->name('activebanner');

    Route::match(['get', 'post'], '/desactivebanner/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivebanner'])->name('desactivebanner');

    Route::match(['get', 'post'], '/personnel', [App\Http\Controllers\ParametrageController::class, 'personnel'])->name('personnel');

    Route::match(['get', 'post'], '/creerpersonnel', [App\Http\Controllers\ParametrageController::class, 'creerpersonnel'])->name('creerpersonnel');

    Route::match(['get', 'post'], '/modifierpersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierpersonnel'])->name('modifierpersonnel');

    Route::match(['get', 'post'], '/activepersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'activepersonnel'])->name('activepersonnel');

    Route::match(['get', 'post'], '/desactivepersonnel/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepersonnel'])->name('desactivepersonnel');

    Route::match(['get', 'post'], '/activepersonnelres/{id}', [App\Http\Controllers\ParametrageController::class, 'activepersonnelres'])->name('activepersonnelres');

    Route::match(['get', 'post'], '/desactivepersonnelres/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivepersonnelres'])->name('desactivepersonnelres');

    Route::match(['get', 'post'], '/help', [App\Http\Controllers\ParametrageController::class, 'help'])->name('help');

    Route::match(['get', 'post'], '/creerhelp', [App\Http\Controllers\ParametrageController::class, 'creerhelp'])->name('creerhelp');

    Route::match(['get', 'post'], '/modifierhelp/{id}', [App\Http\Controllers\ParametrageController::class, 'modifierhelp'])->name('modifierhelp');

    Route::match(['get', 'post'], '/activehelp/{id}', [App\Http\Controllers\ParametrageController::class, 'activehelp'])->name('activehelp');

    Route::match(['get', 'post'], '/desactivehelp/{id}', [App\Http\Controllers\ParametrageController::class, 'desactivehelp'])->name('desactivehelp');

});

Route::get('/deconnexion', [App\Http\Controllers\HomeController::class, 'deconnexion']);


