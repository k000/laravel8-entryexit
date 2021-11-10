<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// 一旦ガードなど抜きで考えて作成する
// TODO groupとガードの設定をする
Route::get('/entryexit/create', [App\Http\Controllers\EntryExitController::class, 'create']);
Route::post('/entryexit/store',[App\Http\Controllers\EntryExitController::class, 'store']);









Route::get('/item/create',function(){
    return view('item.create');
});

Route::post('/item/store',[App\Http\Controllers\ItemController::class, 'store']);


Route::get('/warehouse/create',function(){
    return view('warehouse.create');
});

Route::post('/warehouse/store',[App\Http\Controllers\WarehouseController::class, 'store']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
