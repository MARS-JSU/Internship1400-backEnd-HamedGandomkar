<?php

use App\Http\Controllers\OperationController;
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

Route::middleware('polyValidation')->group(function(){
    Route::post("/derivative", [OperationController::class, "derivative"]);
    Route::post("/sum", [OperationController::class, "sum"]);
    Route::post("/sub", [OperationController::class, "sub"]);
    Route::post("/multiply", [OperationController::class, "multiply"]);
    Route::post("/calculate", [OperationController::class, "calculate"]);
});
