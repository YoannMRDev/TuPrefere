<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Utilisateur;
use Core\Models\Groupe_Utilisateur;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class SalonController
{

    public function index()
    {
        $groupeInfo = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);
        $utilisateursGroupe = Utilisateur::getAllUserofGroup($groupeInfo[0]->idGroupe);
        View::render("Salon.php", ["groupeInfo" => $groupeInfo, "utilisateursGroupe" => $utilisateursGroupe]);
    }

}
