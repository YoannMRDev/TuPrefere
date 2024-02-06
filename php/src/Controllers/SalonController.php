<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Categorie;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class SalonController
{

    public function index()
    {
        View::render("Salon.php");
    }

}
