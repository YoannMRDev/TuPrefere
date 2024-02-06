<?php

namespace Core\Controllers;

use Core\Views\View;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class RejoindrePartieController
{

    public function index()
    {
        View::render("RejoindrePartie.php");
    }

}
