<?php
	
	use App\Http\Controllers\AuthController;
	use App\Http\Controllers\PostController;
	use Illuminate\Http\Request;
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
	
	Route::group([
		'middleware' => 'api',
		'prefix' => 'auth'
	
	], function ($router) {
		Route::post('/login', [AuthController::class, 'login']);
		Route::post('/register', [AuthController::class, 'register']);
		Route::post('/logout', [AuthController::class, 'logout']);
		Route::post('/refresh', [AuthController::class, 'refresh']);
		Route::get('/user-profile', [AuthController::class, 'userProfile']);
		
	});
	
	Route::get('/posts',[PostController::class,'index']);
	Route::get('/post/{slug}' , [PostController::class, 'show']);
	Route::middleware('auth')->group(function () {
		Route::post('/post' , [PostController::class, 'create']);
		Route::patch('/post/{id}' , [PostController::class, 'update']);
		Route::delete('/post/{id}' , [PostController::class, 'destroy']);
	});
	
	