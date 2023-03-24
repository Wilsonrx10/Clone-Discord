<?php

use App\Http\Controllers\Auth\CompleteRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyAccountController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*--------------------------------------------------------------------------
Router Inertia 
--------------------------------------------------------------------------*/

Route::get('/', function () {
    if (Auth::check() && Auth::user()->cad_concluir == 0) {
        return Redirect::route('user.complete');
    } 
    else if(Auth::check() && Auth::user()->cad_concluir == 1) {
        return Redirect::route('Channel');
    }
    else {
        return Inertia::render('auth/Login');
    }
})->name('login');


Route::get('/register', function () {
    return Inertia::render('auth/Register');
})->name('register');


Route::get('/sucesso_cadastro', function () {
    return Inertia::render('auth/SuccessCad');
})->name('sucesso_cadastro');


Route::get('account_verificacion', [VerifyAccountController::class, 'verificar_token_usuario'])->name("user.verificacion");
Route::get('registre_complete', [CompleteRegistrationController::class, 'fases_concluir_cadastro'])->name("user.complete");
Route::post('concluir_cadastro', [CompleteRegistrationController::class, 'Concluir_cadastro']);

/* Auth */
Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'Register']);
    Route::any('login', [LoginController::class, 'Login']);
});

Route::middleware('auth')->group(function () {

    Route::get('logout', [LogoutController::class,'Logout'])->name("user.logout");

    Route::controller(UserController::class)->group(function () {
        Route::get('/channel', 'Channel')->name('Channel');
    });

    Route::controller(UserStatusController::class)->group(function(){
        Route::post('atualizarStatus', 'updateStatus');
        Route::get('BuscarTiposStatus','getTypeStatus');
    });

    Route::controller(ServidorController::class)->group(function () {
        Route::post('/CriarServidor', 'CriarNovoServidor');
        Route::get('/BuscarListaServidores', 'getServers');
        Route::get('/BuscarTiposServidor', 'getTypeServer');
        Route::get('/AbrirServidor/{server}', 'OpenServer');
    });


    Route::prefix('channel')->group(function () {

        Route::controller(FriendController::class)->group(function () {
            Route::get('/friend', 'Friend')->name('friend');
            Route::get('/BuscarListaAmigos', 'BuscarListaAmigos');
            Route::get('/BuscarListaUsuariosCompleto', 'BuscarListaUsuariosCompleto');
        });

        Route::controller(MessageController::class)->group(function () {
            Route::get('/BuscarMessages/{user}', 'BuscarMessages');
            Route::post('/EnviarMensagem', 'EnviarMensagem');
        });
    });
});