<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\IncomingController;
use App\Http\Controllers\OutgoingController;
use App\Http\Controllers\TemplateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::prefix('documents')->group(function () {
    Route::get('/', [DocumentController::class, 'index']);
    Route::post('/', [DocumentController::class, 'store']);
    Route::get('{document}', [DocumentController::class, 'show']);
    Route::put('{document}', [DocumentController::class, 'update']);
    Route::delete('{document}', [DocumentController::class, 'destroy']);
});

Route::prefix('companies')->group(function () {
    Route::get('/light', [CompanyController::class, 'getCompanies']);
});

Route::prefix('contacts')->group(function () {
    Route::get('/light', [ContactController::class, 'getContacts']);
});

Route::prefix('templates')->group(function () {
    Route::get('/light', [TemplateController::class, 'getTemplates']);
});

Route::prefix('outgoings')->group(function () {
    Route::get('/', [OutgoingController::class, 'index']);
    Route::get('/{outgoing}', [OutgoingController::class, 'show']);
    Route::post('/', [OutgoingController::class, 'store']);
    Route::put('/{outgoing}', [OutgoingController::class, 'update']);
    Route::delete('/{outgoing}', [OutgoingController::class, 'destroy']);
});

Route::prefix('incomings')->group(function () {
    Route::get('/', [IncomingController::class, 'index']);
});
