<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TempController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WardController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\TenureController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TownshipController;
use App\Http\Controllers\PropertyRentController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MainAgencyInfoController;
  
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
  
Route::group(['middleware' => ['auth','rolepermission']], function() {
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
    Route::resource('agents', AgentController::class);    
    Route::resource('invoices', InvoiceController::class);    
    Route::resource('informations', MainAgencyInfoController::class);
    Route::post('users-disabled/{user_id}',[UserController::class, 'disabled'])->name('users.disabled');
    Route::post('/properties/img-delete', [PropertyController::class,'destory_img'])->name('property.img_delete');    
    Route::post('/properties/doc-delete', [PropertyController::class,'destory_doc'])->name('property.doc_delete');
    Route::post('/property-rent/img-delete', [PropertyRentController::class,'destory_img'])->name('property_rent.img_delete');    
    Route::post('/property-rent/doc-delete', [PropertyRentController::class,'destory_doc'])->name('property_rent.doc_delete');    
    Route::post('/invoices/doc-delete', [InvoiceController::class,'destory_doc'])->name('invoices.doc_delete');    
    Route::get('/auto-complete/get-owners', [OwnerController::class,'get_owners'])->name('owners.get-owners');    
    Route::get('/owners-detail/{owner}/{invtype?}', [OwnerController::class,'get_owner_details'])->name('owners.get-owners-details');  
    Route::get('/get-owners-phone', [OwnerController::class,'get_owners_with_phone'])->name('owners.get-owners-phone');    
    Route::get('/owners-detail-phone/{phonenumber}', [OwnerController::class,'get_owner_details_with_phone'])->name('owners.get-owners-details-phone');    
    Route::get('/profile', [UserController::class,'show'])->name('profile.index');    
    Route::post('/properties/search',[PropertyController::class,'search'])->name('properties.search');
    Route::get('/properties/search/reset',[PropertyController::class,'reset'])->name('properties.search.reset');
    Route::post('/get-property-detail',[PropertyController::class,'get_property_detail'])->name('properties.get-property-detail');
    Route::post('/property_rents/search',[PropertyRentController::class,'search'])->name('property_rents.search');
    Route::get('/property_rents/search/reset',[PropertyRentController::class,'reset'])->name('property_rents.search.reset');
    Route::post('/owners/search',[OwnerController::class,'search'])->name('owners.search');
    Route::get('/owners/search/reset',[OwnerController::class,'reset'])->name('owners.search.reset');
    Route::post('/customers/search',[CustomerController::class,'search'])->name('customers.search');
    Route::get('/customers/search/reset',[CustomerController::class,'reset'])->name('customers.search.reset');
    Route::post('/townships/search',[TownshipController::class,'search'])->name('townships.search');
    Route::get('/townships/search/reset',[TownshipController::class,'reset'])->name('townships.search.reset');
    Route::post('/wards/search',[WardController::class,'search'])->name('wards.search');
    Route::get('/wards/search/reset',[WardController::class,'reset'])->name('wards.search.reset');
    Route::post('/divisions/search',[DivisionController::class,'search'])->name('divisions.search');
    Route::get('/divisions/search/reset',[DivisionController::class,'reset'])->name('divisions.search.reset');
    Route::post('/floors/search',[FloorController::class,'search'])->name('floors.search');
    Route::get('/floors/search/reset',[FloorController::class,'reset'])->name('floors.search.reset');
    Route::post('/tenures/search',[TenureController::class,'search'])->name('tenures.search');
    Route::get('/tenures/search/reset',[TenureController::class,'reset'])->name('tenures.search.reset');
    Route::post('/property_types/search',[PropertyTypeController::class,'search'])->name('property_types.search');
    Route::get('/property_types/search/reset',[PropertyTypeController::class,'reset'])->name('property_types.search.reset');
    Route::post('/invoices/search',[InvoiceController::class,'search'])->name('invoices.search');
    Route::get('/invoices/search/reset',[InvoiceController::class,'reset'])->name('invoices.search.reset');
    Route::post('/users/search',[UserController::class,'search'])->name('users.search');
    Route::get('/users/search/reset',[UserController::class,'reset'])->name('users.search.reset');
    Route::post('/agents/search',[AgentController::class,'search'])->name('agents.search');
    Route::get('/agents/search/reset',[AgentController::class,'reset'])->name('agents.search.reset');
    Route::post('/informations/search',[MainAgencyInfoController::class,'search'])->name('informations.search');
    Route::get('/informations/search/reset',[MainAgencyInfoController::class,'reset'])->name('informations.search.reset');

    Route::get('get-townshipbydivision',[TownshipController::class,'townshipbydivision'])->name('get-townshipbydivision');
    Route::get('get-wardbytownship',[WardController::class,'wardbytownship'])->name('get-wardbytownship');
    Route::post('/properties/softdelete',[PropertyController::class,'softdelete'])->name('properties.softdelete');
    Route::post('/property_rents/softdelete',[PropertyRentController::class,'softdelete'])->name('property_rents.softdelete');
    Route::post('/owners/delete/softdelete',[OwnerController::class,'softdelete'])->name('owners.softdelete');
    Route::post('/invoices/delete/softdelete',[InvoiceController::class,'softdelete'])->name('invoices.softdelete');
    Route::post('/informations/delete/softdelete',[MainAgencyInfoController::class,'softdelete'])->name('informations.softdelete');
    Route::get('/auto-complete/get-partners',[AgentController::class,'get_partners'])->name('auto-complete.get-partners');
    Route::get('/auto-complete/get-partners-phone',[AgentController::class,'get_partners_phone'])->name('auto-complete.get-partners-phone');
    Route::get('/partner-detail/{id}',[AgentController::class,'get_agent_detail'])->name('get-partners-detail');
    Route::get('/partner-detail-phone/{id}',[AgentController::class,'get_agent_detail_phone'])->name('get-partners-detail-phone');    
});
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Route::get('/download',function(){
    
})->name('download');

