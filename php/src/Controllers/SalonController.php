<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Utilisateur;
use Core\Models\Groupe_Utilisateur;
use Core\Session;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class SalonController
{

    public function index()
    {
        $groupeInfo = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);
        View::render("Salon.php", ["groupeInfo" => $groupeInfo]);
    }

    public function getData()
    {
        $groupeInfo = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);
        $utilisateursGroupe = Utilisateur::getAllUserofGroup(end($groupeInfo)->idGroupe);

        $data = array(
            'groupeInfo' => $groupeInfo,
            'utilisateursGroupe' => $utilisateursGroupe
        );

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function leaveSalon()
    {
        // Récupérer les données envoyées par la requête POST
        $data = json_decode(file_get_contents('php://input'));

        // Vérifier si l'utilisateur est connecté
        if (Session::userIsLoggedIn()) {
            // Supprimer l'utilisateur du groupe en utilisant les données reçues (userId)
            $userId = $data->userId;

            // Mettez ici le code pour supprimer l'utilisateur du groupe
            Groupe_Utilisateur::deleteByUtilisateur($userId);

            // Verifier s'il reste des utilisateurs dans le groupe et supprimer le groupe si vide
            // $groupeInfo = Groupe_Utilisateur::getGroupeByUtilisateur($userId);
            // $utilisateursGroupe = Utilisateur::getCountOfAllUserOfGroup($groupeInfo[0]->idGroupe);
            // var_dump($utilisateursGroupe);
            // if ($utilisateursGroupe[0]->count == 0) {
            //     Groupe_Utilisateur::delete($groupeInfo[0]->idGroupe);
            // }

            // Retourner une réponse JSON indiquant le succès de l'opération
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        } else {
            // L'utilisateur n'est pas connecté, retourner une erreur
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Utilisateur non authentifié']);
            exit;
        }
    }

    public function getUserGroupInfo()
    {
        // Vérifier si l'utilisateur est connecté
        if (Session::userIsLoggedIn()) {
            // Récupérer l'ID de l'utilisateur
            $userId = $_SESSION['idUtilisateur'];

            // Retourner les informations sous forme de réponse JSON
            header('Content-Type: application/json');
            echo json_encode(['userId' => $userId]);
            exit;
        } else {
            // L'utilisateur n'est pas connecté, retourner une erreur
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Utilisateur non authentifié']);
            exit;
        }
    }

    public function checkCommencer()
    {
        $groupeInfo = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);
        $commencer = end($groupeInfo)->commencer;

        // Retournez la valeur de commencer sous forme de réponse JSON
        header('Content-Type: application/json');
        echo json_encode(['commencer' => $commencer]);
    }
}
