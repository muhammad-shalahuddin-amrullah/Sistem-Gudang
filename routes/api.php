<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\LocationsController;
use App\Http\Controllers\Api\MutationTypesController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\MutationsController;
use App\Http\Controllers\Api\ItemMutationsController;
use App\Http\Controllers\Api\HistoryItemMutationsController;
use App\Http\Controllers\Api\HistoryUserMutationsController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/categories', CategoriesController::class);
    Route::apiResource('/locations', LocationsController::class);
    Route::apiResource('/mutationtypes', MutationTypesController::class);
    Route::apiResource('/roles', RolesController::class);
    Route::apiResource('/item', ItemsController::class);
    Route::apiResource('/mutation', MutationsController::class);
    Route::apiResource('/itemmutation', ItemMutationsController::class);
    Route::get('/historyitem', [HistoryItemMutationsController::class, 'index']);
    Route::get('/historyitem/{itemId}', [HistoryItemMutationsController::class, 'show']);
    Route::get('/historyuser', [HistoryUserMutationsController::class, 'index']);
    Route::get('/historyuser/{userId}', [HistoryUserMutationsController::class, 'index']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
    // We'll add our task routes here later
});



