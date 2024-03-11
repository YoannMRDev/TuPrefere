<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\RouterUtils;
use Core\Controllers\IndexController;
use Core\Controllers\LoginController;
use Core\Controllers\CreePartieController;
use Core\Controllers\RejoindrePartieController;
use Core\Controllers\SalonController;
use Core\Controllers\JeuController;
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
        SimpleRouter::post('/creePartie', [CreePartieController::class, 'add']);
        SimpleRouter::get('/rejoindrePartie', [RejoindrePartieController::class, 'index']);
        SimpleRouter::post('/rejoindrePartie', [RejoindrePartieController::class, 'join']);
        SimpleRouter::get('/salon', [SalonController::class, 'index']);
        SimpleRouter::get('/salon/data', [SalonController::class, 'getData']);
        SimpleRouter::post('/salon/leave', [SalonController::class, 'leaveSalon']);
        SimpleRouter::get('/salon/user-info', [SalonController::class, 'getUserGroupInfo']);
        SimpleRouter::get('/salon/commencer', [SalonController::class, 'checkCommencer']);  
        SimpleRouter::get('/jeu', [JeuController::class, 'genererQuestion']);
        SimpleRouter::post('/vote', [JeuController::class, 'insertVote']);
        SimpleRouter::get('/jeu/verifierAllQuestionsRepondues', [JeuController::class, 'verifierAllQuestionsRepondues']);
        SimpleRouter::get('/jeu/getVerifierAllQuestionsRepondues', [JeuController::class, 'getVerifierAllQuestionsRepondues']);
        SimpleRouter::get('/jeu/reviewPartie', [JeuController::class, 'reviewPartie']);
        SimpleRouter::get('/jeu/salonFinPartie', [JeuController::class, 'salonFinPartie']);
        SimpleRouter::get('/jeu/quitterPartie', [JeuController::class, 'quitterPartie']);


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
