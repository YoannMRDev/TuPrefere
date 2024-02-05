<?php

namespace Core\Controllers;

use Core\Views\View;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class IndexController
{

    public function index()
    {
        View::render("Accueil.php");
    }

    // public function show($id)
    // {
    //     $tache = Tache::read($id);
    //     View::render("Tache-Show.php",  ["tache" => $tache]);
    // }

    // public function add()
    // {
    //     $categories = Categorie::getAll();
    //     View::render("Tache-Add.php", ["categories" => $categories]);
    // }

    // public function apply_add()
    // {
    //     $data = $this->validate();

    //     if ($data !== false) {
    //         Tache::create($data);

    //         header("Location: /tache");
    //         exit;
    //     } else {
    //         $categories = Categorie::getAll();
    //         View::render("Tache-Add.php", ["categories" => $categories, "error" => true]);
    //     }
    // }


    // public function delete($id)
    // {
    //     Tache::delete($id);

    //     header("Location: /tache");
    //     exit;
    // }

    // public function modify($id)
    // {
    //     $tache = Tache::read($id);
    //     $categories = Categorie::getAll();
    //     View::render("Tache-Modify.php",  ["tache" => $tache, "categories" => $categories]);
    // }

    // public function apply_modify($id)
    // {
    //     $data = $this->validate();

    //     if ($data !== false) {
    //         Tache::update($id, $data);

    //         header("Location: /tache");
    //         exit;
    //     } else {
    //         $tache = Tache::read($id);
    //         $categories = Categorie::getAll();
    //         View::render("Tache-Modify.php",  ["tache" => $tache, "categories" => $categories, "error" => true]);
    //     }
    // }

    // private function validate()
    // {
    //     $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //     $estTerminee = filter_input(INPUT_POST, "estTerminee", FILTER_VALIDATE_BOOL);
    //     $categorie = filter_input(INPUT_POST, "categorie_idCategorie", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //     // Vérifier si les champs sont vides ou nuls
    //     if (empty($titre) || $titre === null) {
    //         return false;
    //     }

    //     if (empty($description) || $description === null) {
    //         return false;
    //     }

    //     if (empty($date) || $date === null) {
    //         return false;
    //     }

    //     if (empty($categorie) || $categorie === null) {
    //         return false;
    //     }

    //     return [
    //         "titre" => $titre,
    //         "description" => $description,
    //         "date" => $date,
    //         "estTerminee" => $estTerminee,
    //         "categorie_idCategorie" => $categorie
    //     ];
    // }
}
