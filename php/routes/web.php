<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\RouterUtils;
use Core\Controllers\IndexController;
use Core\Controllers\LoginController;
use Core\Controllers\CreePartieController;
use Core\Controllers\RejoindrePartieController;
use Core\Controllers\SalonController;
use Core\Session;

//SimpleRouter Login

// Aller à la page de login
SimpleRouter::get('/', [LoginController::class, 'index']);
SimpleRouter::post('/', [LoginController::class, 'login']);
// Crée un compte
SimpleRouter::get('/login/add', [LoginController::class, 'add']);
SimpleRouter::post('/login/add', [LoginController::class, 'apply_add']);

SimpleRouter::group(
    ['middleware' => \Core\Middlewares\AuthMiddleware::class],
    function () {
        SimpleRouter::get('/accueil', [IndexController::class, 'index']);
        SimpleRouter::get('/creePartie', [CreePartieController::class, 'index']);
        SimpleRouter::get('/rejoindrePartie', [RejoindrePartieController::class, 'index']);
        SimpleRouter::get('/salon', [SalonController::class, 'index']);
        
        // SimpleRouter::get('/tache/add', [IndexController::class, 'add']);
        // SimpleRouter::post('/tache/add', [IndexController::class, 'apply_add']);
        // SimpleRouter::get('/tache/{i}', [IndexController::class, 'show']);
        // SimpleRouter::get('/tache/delete/{i}', [IndexController::class, 'delete']);
        // SimpleRouter::get('/tache/modify/{i}', [IndexController::class, 'modify']);
        // SimpleRouter::post('/tache/modify/{i}', [IndexController::class, 'apply_modify']);

        SimpleRouter::get('/user/profile', function () {
            // Uses Auth Middleware
            if (SimpleRouter::request()->authenticated) {
                SimpleRouter::response()->redirect('/accueil');
            } else {
                SimpleRouter::response()->redirect('/');
            }
        });

        SimpleRouter::get('/logout', function () {
            // Uses Auth Middleware
            Session::destroy();
            SimpleRouter::response()->redirect('/');
        });
    }
);

SimpleRouter::group(['middleware' => \Core\Middlewares\AuthMiddleware::class], function () {
    // ...
});
