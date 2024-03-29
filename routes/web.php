<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return 0;
});

Route::get('/pushfromlinux', function (){
	return 1;
});

Route::post('/addUser', [ItemController::class, 'store']);
Route::post('/addFile', [ItemController::class, 'addFile']);


// Route::view('/home', function() {
//     return view('adduser');
// });

Route::view('/add', 'adduser');
Route::view('/tambahfile', 'addfile');
