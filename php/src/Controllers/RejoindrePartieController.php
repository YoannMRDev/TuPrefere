<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Groupe;
use Core\Models\Groupe_Utilisateur;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class RejoindrePartieController
{

    public function index()
    {
        View::render("RejoindrePartie.php");
    }

    public function join()
    {
        $data = [
            "idUtilisateur" => $_SESSION['idUtilisateur'],
            "idGroupe" => $this->validate()->idGroupe,
        ];

        if(Groupe_Utilisateur::create($data) != null){
            header("Location: /salon");
            exit;
        }else{
            echo "Error insert groupe";
        }
    }

    public function validate()
    {
        $code = filter_input(INPUT_POST, "codeRejoindrePartie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$code) {
            return false;
        }

        $groupe = Groupe::codeExist($code);

        if (!is_object($groupe)) {
            return false;
        }

        return $groupe;
    }

}
