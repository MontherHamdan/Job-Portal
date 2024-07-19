<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobApplicationController;

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

Route::get('', fn () => to_route('jobs.index'));

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);


// route to return the user to the login page if he is not logged in
Route::get('login', fn () => to_route('auth.create'))->name('login');

Route::resource('auth', AuthController::class)
    ->only(['create', 'store']);

// route to give alias name for destroy route
Route::delete('logout', fn () => to_route('auth.destroy'))
    ->name('auth.logout');

// route for logout
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');


// this route for jobApplication 
// we add the middleware cause this time we need the user to be authenticated to apply for job
// group mean that every single route inside the function will be have the auth condetion (instead to make each route with auth)
Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    // the middleware('employer') here is customize (we create it) you can check from kernal file in alias method
    Route::middleware('employer')
        ->resource('my-jobs', MyJobController::class);
});
