<?php

namespace Core\Controllers;

use Core\Views\View;

use Core\Session;
use Core\Models\Utilisateur;
use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;



class LoginController
{
    public function index()
    {
        View::render("Login.php", ["login" => true]);
    }

    public function login()
    {
        $data = $this->validate(true); // Mode login = true

        if ($data[0] != false) {
            
            Session::init();
            Session::set("authenticated", true);
            Session::set("idUtilisateur", $data[1]);

            header("Location: /user/profile");
            exit;
        } else {
            View::render("Login.php", ["login" => true, "error" => true, "msgError" => $data[1]]);
        }
    }

    public function logout() {
        Session::init();
        Session::set("authenticated", false);

        return "Formulaire authentification";
    }

    public function add()
    {
        View::render("Login.php", ["login" => false]); // Mode inscription = false
    }

    public function apply_add()
    {
        $data = $this->validate(false);

        if ($data[0] !== false) {
            Utilisateur::create($data[1]);

            header("Location: /");
            exit;
        } else {
            View::render("Login.php", ["login" => false, "error" => true, "msgError" => $data[1]]);
        }
    }

    private function validate(bool $login = false)
    {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
        $mdp = filter_input(INPUT_POST, "mdp", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Vérifier si les champs sont vides ou nuls
        if (empty($email) || $email === null) {
            return [false, "Tous les champs doivent être remplis !"];
        }

        // Vérifier si les champs sont vides ou nuls
        if (empty($mdp) || $mdp === null) {
            return [false, "Tous les champs doivent être remplis !"];
        }

        // Si on est en mode inscription
        if (!$login) {

            // Vérifier si l'email existe déjà
            if ($this->emailExist($email)) {
                return [false, "L'email existe déjà !"];
            }

            $mdpConfirmation = filter_input(INPUT_POST, "mdpConfirmation", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Vérifier si les champs sont vides ou nuls
            if (empty($pseudo) || $pseudo === null) {
                return [false, "Tous les champs doivent être remplis !"];
            }

            // Vérifier la longueur du pseudo
            if (strlen($pseudo) < 4) {
                return [false, "Le pseudo doit contenir au moins 3 caractères !"];
            } 

            // Vérifier si les champs sont vides ou nuls
            if (empty($mdpConfirmation) || $mdpConfirmation === null) {
                return [false, "Tous les champs doivent être remplis !"];
            }

            // Vérifier si les mots de passe correspondent
            if ($mdp !== $mdpConfirmation) {
                return [false, "Les mots de passe ne correspondent pas !"];
            }

            // Vérifier la longueur du mot de passe
            if (strlen($mdp) < 8 && strlen($mdpConfirmation) < 8) {
                return [false, "Le mot de passe doit contenir au moins 8 caractères !"];
            }

            return [
                true,
                [
                    "pseudo" => $pseudo,
                    "email" => $email,
                    "mdp" => $this->mdpHash($mdp)
                ]
            ];
        } else { // Si on est en mode login

            // Vérifier si l'utilisateur existe
            $utilisateur = $this->utilisateurExist($email);
            if ($utilisateur === false) {
                return [false, "L'utilisateur n'existe pas !"];
            }

            //Vérifier si le mot de passe est correct
            if (!password_verify($mdp, $utilisateur->mdp)) {
                return [false, "Le mot de passe est incorrect !"];
            }

            return [true, $utilisateur->idUtilisateur];
        }
    }

    private function emailExist(string $email)
    {
        $utilisateur = Utilisateur::searchEmail("email", $email);

        if ($utilisateur === null) {
            return true;
        } else {
            return false;
        }
    }

    private function utilisateurExist(string $email)
    {
        $utilisateur = Utilisateur::searchUtilisateur($email);

        if ($utilisateur !== null) {
            return $utilisateur;
        } else {
            return false;
        }
    }

    private function mdpHash(string $mdp)
    {
        // Générer un sel aléatoire
        $options = [
            'memory_cost' => 1 << 17,  // 128 MB
            'time_cost'   => 4,      // 4 iterations
            'threads'     => 2,      // Utilize 2 threads
        ];

        // Hacher le mot de passe avec Argon2
        return password_hash($mdp, PASSWORD_ARGON2I, $options);
    }
}
