<?php

use App\Http\Controllers\MusicianController;
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
Route::resource('musicians', MusicianController::class);
Route::get('/upload', [MusicianController::class, 'upload'])->name('upload');
Route::post('/put', [MusicianController::class, 'put'])->name('put');

// Route::get('/image-editor', function () {
//     return view('image-editor');
// });

// Route::post('/upload-image', function (Illuminate\Http\Request $request) {
//     $image = $request->file('image');
//     $imageName = time() . '.' . $image->getClientOriginalExtension();
//     $image->move(public_path('images'), $imageName);

//     return response()->json(['image' => $imageName]);
// });
