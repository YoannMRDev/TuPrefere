<?php 

namespace Core\Middlewares;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;
use Core\Session;

class AuthMiddleware implements IMiddleware
{
	public function handle(Request $request) : void
	{
		Session::init();
		
		// Vérifiez si l'utilisateur est authentifié
        if (!Session::userIsLoggedIn()) {
            // Si l'utilisateur n'est pas authentifié, redirigez-le vers la page de connexion
            // Vous pouvez personnaliser cette redirection selon vos besoins
            header('Location: /');
            exit(); // Assurez-vous de quitter le script après la redirection
        }

		// Do authentication
		$request->authenticated = Session::get("authenticated");
	}
}