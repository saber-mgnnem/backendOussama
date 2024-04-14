<?php

use App\Http\Controllers\AbsanceController;
use App\Http\Controllers\AnnéeScolaireController;
use App\Http\Controllers\AttributionController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\EmploiDuTempsClasseController;
use App\Http\Controllers\EmploiDuTempsEnseignantController;
use App\Http\Controllers\EnseignantRéunionController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ExerciceController;
use App\Http\Controllers\InscriptionEnseignantController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PublicCourController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\MatiereController;


use Laravel\Sanctum\Sanctum;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);
Route::get('homeTeams',[UserController::class, 'index']);

Route::middleware(['auth:sanctum','isAdmin'])->group( function(){
    Route::post('adminlogout',[AuthController::class, 'logout']);
    Route::get('CheckingAuth', function(){
        return response()->json(['message'=>'You are in', 'status'=>200], 200);

    });

    Route::get('user',[UserController::class, 'index']);
    Route::post('/AdminUpdate_profile/{id}',[UserController::class, 'Update']);

    Route::delete('/delete_user/{id}',[UserController::class, 'destroy']);
    Route::get('get_user/{id}',[UserController::class,'getuser']);

});


Route::middleware(['auth:sanctum','isEnseignant'])->group( function(){

    Route::post('enseignantlogout',[AuthController::class, 'logout']);
    Route::get('EnseignantCheckingAuth', function(){
        return response()->json(['message'=>'You are in', 'status'=>200], 200);

    });
    Route::get('Enseignantuser',[UserController::class, 'index']);
    Route::get('/Enseignant_Parent_user',[UserController::class, 'index']);
    Route::post('/update_profile/{id}',[UserController::class, 'Update']);

});



Route::middleware(['auth:sanctum','isEtudiant'])->group( function(){

    Route::post('logout',[AuthController::class, 'logout']);
    Route::get('eleveCheckingAuth', function(){
        return response()->json(['message'=>'You are in', 'status'=>200], 200);

    });

});
