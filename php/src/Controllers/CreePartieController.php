<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Categorie;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class CreePartieController
{

    public function index()
    {
        $categories = Categorie::getAll();
        View::render("CreePartie.php", ["categories" => $categories]);
    }

}
