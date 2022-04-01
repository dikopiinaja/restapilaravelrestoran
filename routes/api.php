<?php

// use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\API\AuthController;
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

// Route::get('/barang', [BarangController::class, 'index']);
// Route::post('/barang', [BarangController::class, 'store']);
// Route::get('/barang/{id}', [BarangController::class, 'show']);
// Route::post('/barang/{id}', [BarangController::class, 'update']);
// Route::delete('/barang/{id}', [BarangController::class, 'destroy']);

// Route::resource('barang', BarangController::class);

// Route::get('/menu', [MenuController::class, 'index']);
// Route::post('/menu', [MenuController::class, 'store']);
// Route::put('/transaction/{id}', [TransactionController::class, 'update']);
// Route::get('/menu/{id}', [MenuController::class, 'show']);
// Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);

Route::resource('/transaction', TransactionController::class)->except(['create', 'edit']);
Route::resource('/menu', MenuController::class)->except(['create', 'edit']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/profile', function(Request $request){
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
