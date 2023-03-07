<?php

use App\Http\Controllers\Auth\CompleteRegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyAccountController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServidorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


/*--------------------------------------------------------------------------
Router Inertia 
--------------------------------------------------------------------------*/

Route::get('/', function () {
    $user = Auth::user();
    if (Auth::check() == true) {
        if ($user->cad_concluir == 0) {
            return Redirect::route('user.complete');
        } else {
            return Redirect::route('Channel');
        }
    } else {
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
Route::get('registre_complete', [CompleteRegistrationController::class,'fases_concluir_cadastro'])->name("user.complete");
Route::post('concluir_cadastro', [CompleteRegistrationController::class,'Concluir_cadastro']);

/* Auth */
Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class,'Register']);
    Route::any('login', [LoginController::class,'Login']);
});

/* User */
Route::controller(UserController::class)->group(function () {

    Route::middleware('verificarlogin')->group(function () {
        Route::get('/channel','Channel')->name('Channel');
        Route::get('logout','logout')->name("user.logout");
        Route::post('atualizarStatus','atualizarStatus');
    });
});

/* Channel */

Route::controller(ServidorController::class)->group(function () {
    Route::middleware('verificarlogin')->group(function() {
        Route::post('/CriarServidor','CriarNovoServidor');
        Route::get('/BuscarListaServidores','BuscarListaServidores');
        Route::get('/AbrirServidor','AbrirServidor');
    });
});

/* Friend */

Route::prefix('channel')->group(function () {
    Route::middleware('verificarlogin')->group(function () {

        Route::controller(FriendController::class)->group(function () {
            Route::get('/friend','Friend')->name('friend');
            Route::get('/BuscarListaAmigos', 'BuscarListaAmigos');
            Route::get('/BuscarListaUsuariosCompleto', 'BuscarListaUsuariosCompleto');
        });

        Route::controller(MessageController::class)->group(function () {
            Route::get('/BuscarMessages', 'BuscarMessages');
            Route::post('/EnviarMensagem', 'EnviarMensagem');
        });
    });
});