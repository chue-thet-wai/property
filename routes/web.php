<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\TenureController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PropertyRentController;
use App\Http\Controllers\FloorController;
  
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
    return view('auth.login');
});
  
Auth::routes();
  
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('properties', PropertyController::class); 
    Route::resource('banners', BannerController::class);     
    Route::resource('owners', OwnerController::class);     
    Route::resource('customers', CustomerController::class);     
    Route::resource('divisions', DivisionController::class);     
    Route::resource('townships', TownshipController::class); 
    Route::resource('wards', WardController::class);     
    Route::resource('tenures', TenureController::class);     
    Route::resource('property_types', PropertyTypeController::class);     
    Route::resource('floors', FloorController::class);     
    Route::resource('property_rents', PropertyRentController::class);     

    Route::post('/properties/img-delete', [PropertyController::class,'destory_img'])->name('property.img_delete');    
    Route::post('/properties/doc-delete', [PropertyController::class,'destory_doc'])->name('property.doc_delete');
    Route::post('/property-rent/img-delete', [PropertyRentController::class,'destory_img'])->name('property_rent.img_delete');    
    Route::post('/property-rent/doc-delete', [PropertyRentController::class,'destory_doc'])->name('property_rent.doc_delete');    
    Route::get('/get-owners', [OwnerController::class,'get_owners'])->name('owners.get-owners');    
    Route::get('/owners-detail/{owner}', [OwnerController::class,'get_owner_details'])->name('owners.get-owners-details');    
    Route::get('/profile', [UserController::class,'show'])->name('profile.index');    
    Route::post('/properties/search',[PropertyController::class,'search'])->name('properties.search');
    Route::get('/properties/search/reset',[PropertyController::class,'reset'])->name('properties.search.reset');
    Route::post('/property_rents/search',[PropertyRentController::class,'search'])->name('property_rents.search');
    Route::get('/property_rents/search/reset',[PropertyRentController::class,'reset'])->name('property_rents.search.reset');
    Route::post('/owners/search',[OwnerController::class,'search'])->name('owners.search');
    Route::get('/owners/search/reset',[OwnerController::class,'reset'])->name('owners.search.reset');
    Route::post('/customers/search',[CustomerController::class,'search'])->name('customers.search');
    Route::get('/customers/search/reset',[CustomerController::class,'reset'])->name('customers.search.reset');
    // Route::post('/temp/img-delete', [TempController::class,'destory'])->name('temp.img_delete');    
    // Route::post('/temp/img-add',[TempController::class,'add'])->name('temp.img_add');
    Route::get('get-townshipbydivision',[TownshipController::class,'townshipbydivision'])->name('get-townshipbydivision');
    Route::get('get-wardbytownship',[WardController::class,'wardbytownship'])->name('get-wardbytownship');

});
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('/download',function(){
    
})->name('download');

