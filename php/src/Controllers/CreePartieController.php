<?php

namespace Core\Controllers;

use Core\Filter;
use Core\Views\View;
use Core\Models\Categorie;
use Core\Models\Groupe;
use Core\Models\Groupe_Utilisateur;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class CreePartieController
{

    public function index()
    {
        $categories = Categorie::getAll();
        View::render("CreePartie.php", ["categories" => $categories]);
    }

    public function add()
    {
        $data = $this->validate();
        $data['actif'] = 1;
        $data['code'] = $this->generatCode();

        $idGroupe = Groupe::create($data);

        $data = [
            "idUtilisateur" => $_SESSION['idUtilisateur'],
            "idGroupe" => $idGroupe,
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
        $nbJoueur = filter_input(INPUT_POST, 'nbJoueur', FILTER_SANITIZE_NUMBER_INT);
        $nbQuestion = filter_input(INPUT_POST, 'nbQuestion', FILTER_SANITIZE_NUMBER_INT);
        $tempsReponse = filter_input(INPUT_POST, 'tempsReponse', FILTER_SANITIZE_NUMBER_INT);
        $idCategorie = filter_input(INPUT_POST, 'categorie', FILTER_SANITIZE_NUMBER_INT);

        if ($nbJoueur > 10 || $nbJoueur < 2) {
            return false;
        }

        if(!$nbJoueur){
            return false;
        }

        if ($nbQuestion > 20 || $nbQuestion < 2) {
            return false;
        }

        if(!$nbQuestion){
            return false;
        }

        if ($tempsReponse != 30 && $tempsReponse != 60 && $tempsReponse != 90 && $tempsReponse != 120 && $tempsReponse != 180 && $tempsReponse != 300) {
            return false;
        }

        if(!$tempsReponse){
            return false;
        }

        if(!$idCategorie){
            return false;
        }
        else{
            $categorieExist = Categorie::read($idCategorie);
            if (!is_object($categorieExist) || !isset($categorieExist)) {
                return false;
            }
        }

        return [
            'nbJoueur' => $nbJoueur,
            'nbQuestion' => $nbQuestion,
            'tempsReponse' => $tempsReponse,
            'idCategorie' => $idCategorie,
        ];
    }

    public function generatCode()
    {
        $code = substr(md5(uniqid()), 0, 8);

        if (!is_object(Groupe::codeExist($code))) {
            return "#" . $code;
        }else{
            $this->generatCode();
        }
    }
}
