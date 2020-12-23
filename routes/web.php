<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/login', 'LoginController@form')->name('login');
Route::post('/login', 'LoginController@authenticate');

Route::get('/auth/login', function () {
    return Socialite::driver('keycloak')->redirect();
});

Route::get('/auth/callback', function () {
    $keycloakUser = Socialite::driver('keycloak')->user();

    $user = \App\User::where(['email' => $keycloakUser->email ])->first();

    if ($user == null) abort(401); else {
        Auth::login($user);
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', 'LoginController@logout');

    Route::get('/home', 'HomeController@index');
});
