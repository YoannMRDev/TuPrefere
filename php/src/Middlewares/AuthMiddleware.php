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
		// Do authentication
		$request->authenticated = Session::get("authenticated");
	}
}