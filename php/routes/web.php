<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\RouterUtils;
use Core\Controllers\IndexController;
use Core\Controllers\LoginController;
use Core\Models\Utilisateur;
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
        // Voir toutes les tâches
        SimpleRouter::get('/accueil', [IndexController::class, 'index']);
        // Ajouter une tâche
        SimpleRouter::get('/tache/add', [IndexController::class, 'add']);
        SimpleRouter::post('/tache/add', [IndexController::class, 'apply_add']);
        // Voir une tâche
        SimpleRouter::get('/tache/{i}', [IndexController::class, 'show']);
        // Effacer une tâche
        SimpleRouter::get('/tache/delete/{i}', [IndexController::class, 'delete']);
        // Modifier une tâche
        SimpleRouter::get('/tache/modify/{i}', [IndexController::class, 'modify']);
        SimpleRouter::post('/tache/modify/{i}', [IndexController::class, 'apply_modify']);

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
