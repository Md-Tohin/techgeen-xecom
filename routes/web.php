<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SetupController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
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
})->name('frontend.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  admin route
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    //  role & permission
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/get', [RoleController::class, 'getAll'])->name('admin.get-role');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/edit/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    //  attributes
    Route::resource('/attributes', AttributeController::class);
    Route::get('attributes/{id}/status', [AttributeController::class, 'changeStatus'])->name('attributes.status');
    Route::post('attributes/update', [AttributeController::class, 'updateAttributes'])->name('attributes.update');   

    //  attributes value
    Route::resource('attributes-value', AttributeValueController::class);
    Route::get('attributes-value/{id}/status', [AttributeValueController::class, 'changeStatus'])->name('attributes-value.status');
    Route::post('attributes-value/update', [AttributeValueController::class, 'update'])->name('attributes-value.update');
    Route::get('attribute/{attribute_id}/values', [AttributeValueController::class, 'attributeValues'])->name('attributes-value.values');

    //  category
    Route::resource('/categories', CategoryController::class);
    Route::get('categories/{id}/status', [CategoryController::class, 'changeStatus'])->name('categories.status');
    Route::get('append-categories-level', [CategoryController::class, 'appendCategoriesLevel'])->name('categories.append-categories-level');

    //  brand
    Route::resource('/brands', BrandController::class);
    Route::get('brands/{id}/status', [BrandController::class, 'changeStatus'])->name('brands.status');

    //  colors
    Route::resource('/colors', ColorController::class);
    Route::get('colors/{id}/status', [ColorController::class, 'changeStatus'])->name('colors.status');
    Route::post('colors/update', [ColorController::class, 'updateColors'])->name('colors.update');

    //  product
    Route::group(['prefix'=>'products'],function(){
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/{id}/status', [ProductController::class, 'changeStatus'])->name('products.status');
    });    

    //  website setup general part
    Route::prefix('setup')->group(function() {
        Route::get('general', [SetupController::class, 'generalSetting'])->name('setup.general-settings');
        Route::post('general', [SetupController::class, 'generalSettingStore'])->name('setup.general-settings.store');
        Route::post('seo', [SetupController::class, 'seoSettingStore'])->name('setup.seo-settings.store');
    });

});

//  seller route
Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard');
});


//  user route
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
});

require __DIR__.'/auth.php';
