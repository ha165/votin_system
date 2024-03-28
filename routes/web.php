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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\ElectionsController;
use App\Http\Controllers\PartiesController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\BallotController;

Route::get('/', function () {
	return view('welcome');
});


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
	Route::get('user-management', function () {
		return view('admin.pages.voters.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('admin.pages.voters.user-profile');
	})->name('user-profile');
});

Route::get('/', function () {
	return redirect('sign-in'); })->middleware('guest');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('user.dashboard');
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
Route::delete('/voters/{voter}', [VoterController::class, 'destroy'])->name('voters.destroy');
Route::get('/voter-distribution-by-course', [VoterController::class, 'getVoterDistributionByCourse']);


/*candidates routes */
Route::get('/candidates', [CandidatesController::class, 'index'])->name('candidates');
Route::get('/candidates/add', [CandidatesController::class, 'create'])->name('candidates.create');
Route::post('/candidates', [CandidatesController::class, 'store'])->name('candidates.store');
Route::put('/candidates/{candidate}', [CandidatesController::class, 'update'])->name('candidates.update');
Route::get('/candidates/{candidate}/edit', [CandidatesController::class, 'edit'])->name('candidates.edit');
Route::delete('/candidates/{candidate}', [CandidatesController::class, 'destroy'])->name('candidate.delete');

/*Party routes */
Route::get('/parties', [PartiesController::class, 'index'])->name('parties');
Route::get('/parties/add', [PartiesController::class, 'create'])->name('parties.create');
Route::post('/parties', [PartiesController::class, 'store'])->name('parties.store');
Route::put('/parties/{parties}', [PartiesController::class, 'update'])->name('parties.update');
Route::get('/parties/{parties}/edit', [PartiesController::class, 'edit'])->name('parties.edit');
Route::delete('/parties/{parties}', [PartiesController::class, 'destroy'])->name('parties.delete');

/*Position routes */
Route::get('/positions', [PositionsController::class, 'index'])->name('positions');
Route::get('/positions/add', [PositionsController::class, 'create'])->name('positions.create');
Route::post('/positions', [PositionsController::class, 'store'])->name('positions.store');
Route::put('/positions/{positions}', [PositionsController::class, 'update'])->name('positions.update');
Route::get('/positions/{positions}/edit', [PositionsController::class, 'edit'])->name('positions.edit');
Route::delete('/positions/{positions}', [PositionsController::class, 'destroy'])->name('positions.delete');

/*election routes */
Route::get('/elections', [ElectionsController::class, 'index'])->name('elections');
Route::get('/elections/add', [ElectionsController::class, 'create'])->name('elections.create');
Route::post('/elections', [ElectionsController::class, 'store'])->name('elections.store');
Route::put('/elections/{elections}', [ElectionsController::class, 'update'])->name('elections.update');
Route::get('/elections/{elections}/edit', [ElectionsController::class, 'edit'])->name('elections.edit');
Route::delete('/elections/{elections}', [ElectionsController::class, 'destroy'])->name('elections.delete');

Route::get('/generate-pdf', [CandidatesController::class, 'generatePDF'])->name('generate-pdf');

Route::post('/ballot/save', [BallotController::class, 'saveleader'])->name('save_leader');
