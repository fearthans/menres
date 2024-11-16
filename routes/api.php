<?php

use App\Http\Controllers\Api\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// DIBAWAH INI MERUPAKAN KUMPULAN API
Route::controller(DataController::class)->group(function () {
    
    // datatable of roles and 2 button type for witdh screen   
    Route::get('/role-big', 'rolesBig')->name('data.role-big');
    Route::get('/role-small', 'rolesSmall')->name('data.role-small');
    
    // datatable of users and 2 button type for witdh screen   
    Route::get('/user-big', 'usersBig')->name('data.user-big');
    Route::get('/user-small', 'usersSmall')->name('data.user-small');

    Route::get('/category', 'categories')->name('data.category');
    Route::get('/asset', 'assets')->name('data.assets');
    Route::get('/requirement', 'requirements')->name('data.requirements');
    
    // for risk_owner (risk analize & mitigation) 
    Route::get('/analyze', 'analayzeRisks')->name('data.analyze-risks');
    Route::get('/mitigation', 'mitigationRisks')->name('data.mitigation-risks');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
