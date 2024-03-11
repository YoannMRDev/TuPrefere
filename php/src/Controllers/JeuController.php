<?php

namespace Core\Controllers;

use Core\Models\Groupe;
use Core\Views\View;
use Core\Models\Utilisateur;
use Core\Models\Groupe_Utilisateur;
use Core\Models\Groupe_Question;
use Core\Models\Question;
use Core\Models\Voter;
use Core\Session;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class JeuController
{
    public function genererQuestion()
    {
        $groupe = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);

        // Verifier si les questions n'ont pas déjà été générées
        if (end($groupe)->commencer != 1) {
            // Récupérer toutes les questions disponibles pour la catégorie du groupe
            $questionsDisponibles = Question::readByCategorie(end($groupe)->idCategorie);

            // Mélanger les questions pour éviter de toujours prendre les mêmes
            shuffle($questionsDisponibles);

            $questionIds = [];

            // S'assurer que le nombre de questions disponibles est suffisant
            if (count($questionsDisponibles) >= end($groupe)->nbQuestion) {
                // Sélectionner les premières questions uniques jusqu'à atteindre le nombre requis
                for ($i = 0; $i < end($groupe)->nbQuestion; $i++) {
                    $questionIds[] = $questionsDisponibles[$i]->idQuestion;
                }
            } else {
                // Si le nombre de questions disponibles est insuffisant, sélectionner toutes les questions disponibles
                foreach ($questionsDisponibles as $question) {
                    $questionIds[] = $question->idQuestion;
                }
            }

            // Mélanger à nouveau la liste de questions pour assurer un ordre aléatoire
            shuffle($questionIds);

            foreach ($questionIds as $index => $question) {
                try {
                    Groupe_Question::create(["idGroupe" => end($groupe)->idGroupe, "idQuestion" => $question]);
                } catch (\Exception $e) {
                }
            }

            // Mettre a jour la colonne commencer du groupe
            Groupe::updateCommencer(1, end($groupe)->idGroupe);

            View::render("Jeu.php", ["questionIds" => $questionIds, "questionCount" => count($questionIds), "groupe" => $groupe]);
        } else {
            $questions = Groupe_Question::getAllQuestionByGroup(end($groupe)->idGroupe);

            foreach ($questions as $index => $question) {
                $questionIds[] = $question->idQuestion;
            }

            View::render("Jeu.php", ["questionIds" => $questionIds, "questionCount" => count($questionIds), "groupe" => $groupe]);
        }
    }

    public function insertVote()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (isset($requestData['idQuestion'], $requestData['choix'], $requestData['idUtilisateur'], $requestData['dateSaisie'], $requestData['idGroupe'])) {
            $idQuestion = $requestData['idQuestion'];
            $choix = $requestData['choix'];
            $idUtilisateur = $requestData['idUtilisateur'];
            $dateSaisie = $requestData['dateSaisie'];
            $idGroupe = $requestData['idGroupe'];

            Voter::create(["idQuestion" => $idQuestion, "choix" => $choix, "idUtilisateur" => $idUtilisateur, "dateSaisie" => $dateSaisie, "idGroupe" => $idGroupe]);

            echo json_encode(['success' => true, 'message' => 'Vote enregistré avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Données manquantes']);
        }
    }

    public function reviewPartie()
    {
        // Recuperer le groupe de l'utilisateur
        $groupe = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);

        // Recuperer toutes les données de la partie
        $tabDataPartie = Voter::getAllDataJeu(end($groupe)->idGroupe);

        // Rediriger l'utilisateur vers la page de révision de la partie
        View::render("ReviewPartie.php", ["tabDataPartie" => $tabDataPartie]);
    }

    public function verifierAllQuestionsRepondues()
    {
        // Recuperer le groupe de l'utilisateur
        $groupe = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);
        
        $_SESSION['allQuestionsRepondues'] = null;

        // Recuperer toutes les joueur du groupe
        $utilisateurs = Groupe_Utilisateur::getUtilisateurIdByGroupe(end($groupe)->idGroupe);

        // Voir si toutes joueurs ont repondu aux questions par rapport au nombre de questions et de votes
        foreach ($utilisateurs as $index => $utilisateur) {
            $nbVote = Voter::getNbVoteByGroupeByUtilisateur(end($groupe)->idGroupe, $utilisateur->idUtilisateur);
            if (end($groupe)->nbQuestion != $nbVote->nbVote) {
                $_SESSION['allQuestionsRepondues'] = false;
                // Rediriger l'utilisateur vers la page d'attente de la fin de la partie
                header("Location: /jeu/salonFinPartie/");
                exit();
            }
        }
        $_SESSION['allQuestionsRepondues'] = true;

        // Rediriger l'utilisateur vers la page de révision de la partie
        header("Location: /jeu/reviewPartie");
        exit();
    }

    public function getVerifierAllQuestionsRepondues(){

        // $this->verifierAllQuestionsRepondues();

        header('Content-Type: application/json');
        echo json_encode(['allQuestionsRepondues' => $_SESSION['allQuestionsRepondues']]);
        exit;
    }

    public function salonFinPartie()
    {
        View::render("SalonFinPartie.php");
    }

    public function quitterPartie()
    {
        // Mettre à jour l'état du groupe, de aftif à inactif (1 => 0)
        $groupe = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);

        Groupe::updateActif(0, end($groupe)->idGroupe);

        // Rediriger l'utilisateur vers la page d'accueil
        header("Location: /accueil");
        exit();
    }
}
