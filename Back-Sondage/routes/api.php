<?php

use App\Http\Controllers\AnswerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyTokenController;
use App\Models\Answer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Cette route permet de récupérer les informations de l'utilisateur authentifié
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes pour l'authentification et la déconnexion de l'utilisateur
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);



// Route pour obtenir la liste de toutes les questions
Route::get('/question/all',[QuestionController::class,'index']);

// Route pour ajouter les réponses
Route::post('/answer/add',[AnswerController::class,'addAnswer']);

// Groupe de routes accessibles uniquement si l'utilisateur est authentifié
Route::middleware('auth:api')->group(function () {
    // Route pour obtenir toutes les réponses de l'utilisateur authentifié
    Route::get('/answer/all',[AnswerController::class,'allAnswer']);

    // Route pour obtenir les réponses groupées de l'utilisateur authentifié
    route::get('/answer/group',[AnswerController::class,"groupedAnswers"]);

    // Autres routes accessibles uniquement si l'utilisateur est connecté
});

// Route pour afficher les réponses en fonction du token fourni
route::get('/answer/display/{token}',[AnswerController::class,'displayAnswers']);
