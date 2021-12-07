<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('slide')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllSlide']);
});

Route::prefix('temoignange')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllTemoignange']);
});

Route::prefix('actualite')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllActualite']);
});

Route::prefix('produitP')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitP']);
});

Route::prefix('produitE')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitE']);
});

Route::prefix('produitphare')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllProduitPhare']);
});

Route::prefix('menufront')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllMenufront']);
});

Route::prefix('partenaire')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPartenaire']);
});

Route::prefix('statistique')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllStatistique']);
});

Route::prefix('personnelresp')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPersonnelResp']);
});

Route::prefix('personnel')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllPersonnel']);
});

Route::prefix('logo')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllLogo']);
});

Route::prefix('banner')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllBanner']);
});

Route::prefix('help')->group( function (){
    Route::get('/',[\App\Http\Controllers\Api\ApiController::class,'getAllHelp']);
});
