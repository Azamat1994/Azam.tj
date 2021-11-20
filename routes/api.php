<?php


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




Route::get('/test', function () {
    return "Hello, Mobile App!";
});
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::middleware('auth:api')->group(function () {
    Route::get('/product/{id}/quantity', 'App\Http\Controllers\Api\ProductController@quantity');
    Route::post('/product/add-quantity', 'App\Http\Controllers\Api\ProductController@addQuantity');
    Route::post('/product/delete-quantity', 'App\Http\Controllers\Api\ProductController@deleteQuantity');
    Route::post('/product/{id}/save-images', 'App\Http\Controllers\Api\ProductController@saveImages');
    Route::post('/product/{id}/delete-images', 'App\Http\Controllers\Api\ProductController@deleteImages');
    Route::post('/crude-product', 'App\Http\Controllers\Api\ProductController@crude');
    Route::get('/product/mostsoldproduct', 'App\Http\Controllers\Api\ProductController@mostSoldProduct');
    Route::get('/product/articul/{articul}', 'App\Http\Controllers\Api\ProductController@getByArticul');
    Route::get('/product/search/{name}','App\Http\Controllers\Api\ProductController@search');
    Route::get('/crude/search/{name}','App\Http\Controllers\Api\CrudeController@search');
    Route::apiResource('/category', 'App\Http\Controllers\Api\CategoryController');
    Route::apiResource('/city', 'App\Http\Controllers\Api\CityController');
    Route::apiResource('/comment', 'App\Http\Controllers\Api\CommentController');
    Route::apiResource('/crude', 'App\Http\Controllers\Api\CrudeController');
    Route::apiResource('/order', 'App\Http\Controllers\Api\OrderController');
    Route::apiResource('/partner', 'App\Http\Controllers\Api\PartnerController');
    Route::apiResource('/permission', 'App\Http\Controllers\Api\PermissionController');
    Route::apiResource('/post', 'App\Http\Controllers\Api\PostController');
    Route::apiResource('/product', 'App\Http\Controllers\Api\ProductController');
    Route::apiResource('/role', 'App\Http\Controllers\Api\RoleController');
    Route::apiResource('/slider', 'App\Http\Controllers\Api\SliderController');
    Route::apiResource('/status', 'App\Http\Controllers\Api\StatusController');
    Route::apiResource('/unit', 'App\Http\Controllers\Api\UnitController')->except(['create', 'edit']);
    Route::apiResource('/user', 'App\Http\Controllers\Api\UserController');
    Route::apiResource('/warehouse', 'App\Http\Controllers\Api\WarehouseController')->except(['create', 'edit']);
});
