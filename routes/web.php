<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserCheckMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    if(Auth::check()){
        if(Auth::user()->role=='admin'){
            return redirect()->route('admin#profile');
        }
        else if(Auth::user()->role=='user'){
            return redirect()->route('user#index');
        }
    }
})->name('dashboard');

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>[AdminCheckMiddleware::class]],function(){

    //Route::get('/','AdminController@index')->name('admin#index');

    //For Admin Controller
    Route::get('profile','AdminController@profile')->name('admin#profile');
    Route::post('updateProfile/{id}','AdminController@updateProfile')->name('admin#updateProfile');
    Route::get('changePassword','AdminController@changePasswordPage')->name('admin#changePasswordPage');
    Route::post('changePassword/{id}','AdminController@changePassword')->name('admin#changePassword');


    //For Category Controller
    Route::get('category','CategoryController@category')->name('admin#category');//list
    Route::get('addCategory','CategoryController@addCategory')->name('admin#addCategory');
    Route::post('createCategory','CategoryController@createCategory')->name('admin#createCategory');
    Route::get('deleteCategory/{id}','CategoryController@deleteCategory')->name('admin#delete');
    Route::get('editCategory/{id}','CategoryController@editCategory')->name('admin#edit');
    Route::post('updateCategory','CategoryController@updateCategory')->name('admin#updateCategory');
    Route::get('category/search','CategoryController@searchCategory')->name('admin#search');
    Route::get('categoryItem/{id}','CategoryController@categoryItem')->name('admin#categoryItem');
    Route::get('category/download','CategoryController@categoryDownload')->name('admin#categoryDownload');

    //For Pizza Controller
    Route::get('pizza', 'PizzaController@pizza')->name('admin#pizza');
    Route::get('createPizza', 'PizzaController@createPizza')->name('admin#createPizza');
    Route::post('insetPizza','PizzaController@insetPizza')->name('admin#insetPizza');
    Route::get('deletePizza/{id}', 'PizzaController@deletePizza')->name('admin#deletePizza');
    Route::get('pizzaInfo/{id}','PizzaController@pizzaInfo')->name('admin#pizzaInfo');
    Route::get('editPizza/{id}','PizzaController@editPizza')->name('admin#editPizza');
    Route::post('updatePizza/{id}','PizzaController@updatePizza')->name('admin#updatePizza');
    Route::get('pizza/search','PizzaController@searchPizza')->name('admin#searchPizza');
    Route::get('pizza/download','PizzaController@downloadPizza')->name('admin#downloadPizza');

    Route::get('userlist','UserController@userList')->name('admin#userList');
    Route::get('adminList','UserController@adminList')->name('admin#adminList');
    Route::get('userList/search','UserController@userSearch')->name('admin#userSearch');
    Route::get('delete/{id}','UserController@delete')->name('admin#delete');
    Route::get('adminList/search','UserController@adminSearch')->name('admin#adminSearch');

    Route::post('contact/create','ContactController@createContact')->name('admin#createContact');
    Route::get('contact/list','ContactController@contactList')->name('admin#contactList');
    Route::get('contact/search','ContactController@contactSearch')->name('admin#contactSearch');

    //Order
    Route::get('order/list','OrderController@orderList')->name('admin#orderList');
    Route::get('order/search','OrderController@searchOrder')->name('admin#searchOrder');
});

Route::group(['prefix'=>'user', 'namespace'=>'User','middleware'=>[UserCheckMiddleware::class]],function(){

    Route::get('/', 'UserController@index')->name('user#index');
    Route::get('user/details/{id}','UserController@pizzaDetails')->name('user#pizzaDetails');
    Route::get('category/search/{id}','UserController@categorySearch')->name('user#categorySearch');
    Route::get('search/item','UserController@searchItem')->name('user#searchItem');
    Route::get('search/data','UserController@searchPizzaData')->name('user#searchPizzaData');
    Route::get('user/order','UserController@order')->name('user#order');
    Route::post('user/placeOrder','UserController@placeOrder')->name('user#placeOrder');
});
