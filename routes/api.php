<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OccupantsController;
use App\Http\Controllers\MdasController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// occupants
Route::post('/addOccupant', [OccupantsController::class, 'add'])->name('occupant.add');
Route::get('/getOccupants', [OccupantsController::class, 'getOccupants'])->name('occupant.getOccupants');

// mdas
Route::post('/mda/personnel', [MdasController::class, 'storeMdaPersonnel'])->name('mda.storeMdaPersonnel');
Route::get('/mda/getMdaPersonnel', [MdasController::class, 'getMdaPersonnel'])->name('mda.getMdaPersonnel');
