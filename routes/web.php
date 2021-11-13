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
Route::get('/entryexit/create', [App\Http\Controllers\EntryExitController::class, 'create'])->middleware(['auth'])->name('entryexitcreate');
Route::post('/entryexit/store',[App\Http\Controllers\EntryExitController::class, 'store'])->middleware(['auth']);

Route::get('/entryexit/all',[App\Http\Controllers\EntryExitController::class, 'all'])->middleware(['auth']);
Route::get('/entryexit/edit/{id}', [App\Http\Controllers\EntryExitController::class, 'edit'])->name('entryexitedit')->middleware(['auth']);

Route::post('/entryexit/update',[App\Http\Controllers\EntryExitController::class, 'update'])->middleware(['auth']);

Route::post('/entryexit/delete/{id}', [App\Http\Controllers\EntryExitController::class, 'delete'])->middleware(['auth'])->name('entryexitdelete');

Route::get('/stocks',[App\Http\Controllers\StockController::class, 'all'])->middleware(['auth']);




Route::get('/item/create',function(){
    return view('item.create');
})->middleware(['auth:admin']);

Route::post('/item/store',[App\Http\Controllers\ItemController::class, 'store'])->middleware(['auth:admin']);


Route::get('/warehouse/create',function(){
    return view('warehouse.create');
})->middleware(['auth:admin']);

Route::post('/warehouse/store',[App\Http\Controllers\WarehouseController::class, 'store'])->middleware(['auth:admin']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    
    Route::get('/dashboard',function () {
        return view('admin.dashboard');
    })->middleware(['auth:admin'])->name('dashboard');

    require __DIR__.'/admin.php';
});