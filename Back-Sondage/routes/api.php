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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);
// route pour ajouter une question
Route::post('/question/add',[QuestionController::class,'store']);
// route pour avoir la liste des questions

Route::get('test', function(){
    return 'OK';
});

Route::get('/question/all',[QuestionController::class,'index']);
Route::post('/answer/add',[AnswerController::class,'addAnswer']);

Route::post('/survey/create',[SurveyTokenController::class,'addSurvey']);
Route::middleware('auth:api')->group(function () {
    Route::get('/answer/all',[AnswerController::class,'allAnswer']);
    route::get('/answer/group',[AnswerController::class,"groupedAnswers"]);
    //routes accessibles uniquement si l'utilisateur est connecté
});
route::get('/answer/display/{token}',[AnswerController::class,'displayAnswers']);


