<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;


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


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::post('/add-ingredient', [IngredientController::class, 'add']);
Route::get('/list-ingredients', [IngredientController::class, 'getAll']);

Route::post('/add-recipe', [RecipeController::class, 'create']);
Route::get('/list-recipes', [RecipeController::class, 'getAllRecipes']);
Route::get('/search-recipes/{keyword?}', [RecipeController::class, 'searchRecipe']);

Route::post('/add-like', [LikeController::class, 'addLike']);
Route::post('/delete-like', [LikeController::class, 'deleteLike']);
Route::post('/add-comment', [LikeController::class, 'addComment']);
Route::post('/delete-comment', [LikeController::class, 'deleteComment']);


