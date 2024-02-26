<?php

namespace Core\Controllers;

use Core\Views\View;
use Core\Models\Utilisateur;
use Core\Models\Groupe_Utilisateur;
use Core\Models\Question;
use Core\Session;

use Pecee\Http\Input\InputHandler;
use Pecee\SimpleRouter\SimpleRouter;

class JeuController
{
    public function genererQuestion()
    {
        $groupe = Groupe_Utilisateur::getGroupeByUtilisateur($_SESSION['idUtilisateur']);

        // Récupérer toutes les questions disponibles pour la catégorie du groupe
        $questionsDisponibles = Question::readByCategorie($groupe[0]->idCategorie);

        // Mélanger les questions pour éviter de toujours prendre les mêmes
        shuffle($questionsDisponibles);

        $questionIds = [];

        // S'assurer que le nombre de questions disponibles est suffisant
        if (count($questionsDisponibles) >= $groupe[0]->nbQuestion) {
            // Sélectionner les premières questions uniques jusqu'à atteindre le nombre requis
            for ($i = 0; $i < $groupe[0]->nbQuestion; $i++) {
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

        // Vous pouvez maintenant utiliser $questionIds pour afficher ou traiter les questions générées
        // Par exemple, vous pouvez les passer à votre vue pour les afficher
        View::render("Jeu.php", ["groupe" => $groupe, "questionIds" => $questionIds]);
    }
}
