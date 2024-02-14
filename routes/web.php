<?php

use Illuminate\Support\Facades\Route;

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
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\ElectionsController;


            

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');


/* voters routes */
Route::get('/voters', [VoterController::class, 'index'])->name('voters');
Route::get('/voters/{voter}/edit', [VoterController::class, 'edit'])->name('voters.edit');
Route::get('/voters/create', [VoterController::class, 'create'])->name('voters.create');
Route::post('/voters', [VoterController::class, 'store'])->name('voters.store');
Route::put('/voters/{voter}', [VoterController::class, 'update'])->name('voters.update');
Route::delete('/voters/{voter}',[VoterController::class,'destroy'])->name('voters.destroy');


/*candidates routes */
Route::get('/candidates',[CandidatesController::class,'index'])->name('candidates');
Route::get('/candidates/add', [CandidatesController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidatesController::class, 'store'])->name('candidates.store');


/*election routes */
Route::get('/elections',[ElectionsController::class,'index'])->name('elections');


Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.voters.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.voters.user-profile');
	})->name('user-profile');
});