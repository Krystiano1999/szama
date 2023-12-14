<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RestaurantMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantRegistrationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);
Route::post('/superadmin/login', [AuthController::class, 'loginSuperAdmin']);

Route::post('/get-restaurants-by-city', [RestaurantController::class, 'getRestaurantsByCity']);
Route::get('/get-restaurants', [RestaurantController::class, 'getRestaurants']);
Route::get('/get-all-restaurants', [RestaurantController::class, 'getAllRestaurants']);
Route::delete('/restaurant/{restaurantId}/delete', [RestaurantController::class, 'deleteRestaurant']);
Route::get('/restaurant-data/{userId}', [RestaurantController::class, 'getRestaurantData']);
Route::put('/update-restaurant-data', [RestaurantController::class, 'updateRestaurantData']);

Route::get('/restaurant/{restaurantId}/menu', [RestaurantMenuController::class, 'getCategoriesAndMenu']);
Route::delete('/menu-item/{itemId}', [RestaurantMenuController::class, 'deleteMenuItem']);
Route::post('/menu-item', [RestaurantMenuController::class, 'addMenuItem']);

Route::prefix('zamowienia')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/restaurant/{restaurantId}', [OrderController::class, 'getOrdersByRestaurant']);
    Route::put('/{orderId}/status', [OrderController::class, 'updateStatus']);
    Route::get('/user/{userId}', [OrderController::class, 'getOrdersByUser']);

});

Route::post('/register-restaurant', [RestaurantRegistrationController::class, 'store']);
Route::get('/restaurant-registrations', [RestaurantRegistrationController::class, 'index']);
Route::delete('/restaurant-registrations/{id}', [RestaurantRegistrationController::class, 'destroy']);
Route::post('/restaurant-registrations/accept/{id}', [RestaurantRegistrationController::class, 'acceptRegistration']);

Route::get('/categories', [CategoryController::class, 'getCategories']);

Route::put('/user/{id}', [UserController::class, 'update']);