<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UrlController;

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
    return redirect('/materials');
});

Route::get('/public/materials', function () {
    return redirect('/materials');
});

Route::get('/public/tags', function () {
    return redirect('/tags');
});

Route::get('/public/categories', function () {
    return redirect('/categories');
});

Route::get('404', function () {
    return view('404');
});

Route::get('/materials', [MaterialController::class, 'showAll']);
Route::get('/materials/tag_search/', [MaterialController::class, 'showSearchByTag']);
Route::get('/materials/profile/{id}', [MaterialController::class, 'showProfile']);
Route::get('/materials/edit/{id}', [MaterialController::class, 'showEdit']);
Route::get('/materials/show/add', [MaterialController::class, 'showAdd']);

Route::get('/materials/create', [MaterialController::class, 'createMaterial']);
Route::get('/materials/update', [MaterialController::class, 'updateMaterial']);
Route::get('/materials/delete', [MaterialController::class, 'deleteMaterial']);

Route::get('/categories', [CategoryController::class, 'showAll']);
Route::get('/categories/edit/{id}', [CategoryController::class, 'showEdit']);
Route::get('/categories/add', [CategoryController::class, 'showAdd']);

Route::get('/categories/create', [CategoryController::class, 'createCategory']);
Route::get('/categories/update', [CategoryController::class, 'updateCategory']);
Route::get('/categories/delete', [CategoryController::class, 'deleteCategory']);

Route::get('/tags', [TagController::class, 'showAll']);
Route::get('/tags/edit/{id}', [TagController::class, 'showEdit']);
Route::get('/tags/add', [TagController::class, 'showAdd']);

Route::get('/tags/create', [TagController::class, 'createTag']);
Route::get('/tags/update', [TagController::class, 'updateTag']);
Route::get('/tags/delete', [TagController::class, 'deleteTag']);

// для изменения в таблице тэгов, прикрепленных к материалу
Route::get('/collections/add', [CollectionController::class, 'addTag']);
Route::get('/collections/delete', [CollectionController::class, 'deleteTag']);

Route::get('/url/add', [UrlController::class, 'addUrl']);
Route::get('/url/update', [UrlController::class, 'updateUrl']);
Route::get('/url/delete', [UrlController::class, 'deleteUrl']);