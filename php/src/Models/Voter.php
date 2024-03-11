<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Voter extends Model
{
    protected int $idUtilisateur;
    protected int $idGroupe;
    protected int $idQuestion;
    protected int $choix;
    protected string $dateSaisie;

    public function __construct($idUtilisateur = "", $idGroupe = "", $idQuestion = "", $choix = "", $dateSaisie = "")
    {
        $this->$idUtilisateur = $idUtilisateur;
        $this->$idGroupe = $idGroupe;
        $this->$idQuestion = $idQuestion;
        $this->$choix = $choix;
        $this->$dateSaisie = $dateSaisie;
    }

    #region getters/setters

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur)
    {
        $this->$idUtilisateur = $idUtilisateur;
    }

    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    public function setIdGroupe(int $idGroupe)
    {
        $this->$idGroupe = $idGroupe;
    }

    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion)
    {
        $this->$idQuestion = $idQuestion;
    }

    public function getChoix()
    {
        return $this->choix;
    }

    public function setChoix(int $choix)
    {
        $this->$choix = $choix;
    }

    public function getDateSaisie()
    {
        return $this->dateSaisie;
    }

    public function setDateSaisie(string $dateSaisie)
    {
        $this->$dateSaisie = $dateSaisie;
    }

    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO voter (idUtilisateur, idGroupe, idQuestion, choix, dateSaisie) values(:idUtilisateur, :idGroupe, :idQuestion, :choix, :dateSaisie)");
        $req->bindParam(":idUtilisateur", $data["idUtilisateur"]);
        $req->bindParam(":idGroupe", $data["idGroupe"]);
        $req->bindParam(":idQuestion", $data["idQuestion"]);
        $req->bindParam(":choix", $data["choix"]);
        $req->bindParam(":dateSaisie", $data["dateSaisie"]);
        $req->execute();
        return $db->lastInsertId();
    }

    public static function read(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, idGroupe, idQuestion, choix, dateSaisie FROM voter WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function delete(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM voter WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, idGroupe, idQuestion, choix, dateSaisie FROM voter");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function getVoteByGroupe(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, idGroupe, idQuestion, choix, dateSaisie FROM voter WHERE idGroupe = :idGroupe  ORDER BY idQuestion ASC");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function getNbVoteByGroupeByUtilisateur(int $idGroupe, int $utilisateur){
        $db = static::getDB();
        $req = $db->prepare("SELECT COUNT(*) as nbVote FROM voter WHERE idGroupe = :idGroupe AND idUtilisateur = :idUtilisateur");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->bindParam(":idUtilisateur", $utilisateur);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetch();
        return $groupe;
    }

    public static function getAllDataJeu(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT u.pseudo, u.idUtilisateur, v.choix, q.choix1, q.choix2, q.idQuestion FROM utilisateur AS u JOIN voter AS v ON u.idUtilisateur = v.idUtilisateur JOIN question AS q ON v.idQuestion = q.idQuestion WHERE v.idGroupe = :idGroupe ORDER BY q.idQuestion ASC;");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }
}
