<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Groupe extends Model
{
    protected int $idGroupe;
    protected string $code;
    protected bool $actif;
    protected int $nbJoueur;
    protected int $nbQuestion;
    protected int $tempsReponse;
    protected bool $commencer;
    protected int $idCategorie;

    public function __construct($idGroupe = "", $code = "", $actif = "", $nbJoueur = "", $nbQuestion = "", $tempsReponse = "", $commencer = "" ,$idCategorie = "")
    {
        $this->$idGroupe = $idGroupe;
        $this->$code = $code;
        $this->$actif = $actif;
        $this->$nbJoueur = $nbJoueur;
        $this->$nbQuestion = $nbQuestion;
        $this->$tempsReponse = $tempsReponse;
        $this->$commencer = $commencer;
        $this->$idCategorie = $idCategorie;
    }

    #region getters/setters

    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    public function setIdGroupe(int $idGroupe)
    {
        $this->$idGroupe = $idGroupe;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(int $code)
    {
        $this->$code = $code;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function setActif(int $actif)
    {
        $this->$actif = $actif;
    }

    public function getNbJoueur()
    {
        return $this->nbJoueur;
    }

    public function setNbJoueur(int $nbJoueur)
    {
        $this->$nbJoueur = $nbJoueur;
    }

    public function getNbQuestion()
    {
        return $this->nbQuestion;
    }

    public function setNbQuestion(int $nbQuestion)
    {
        $this->$nbQuestion = $nbQuestion;
    }

    public function getTempsReponse()
    {
        return $this->tempsReponse;
    }

    public function setTempsReponse(int $tempsReponse)
    {
        $this->$tempsReponse = $tempsReponse;
    }

    public function getCommencer()
    {
        return $this->commencer;
    }

    public function setCommencer(int $commencer)
    {
        $this->$commencer = $commencer;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie)
    {
        $this->$idCategorie = $idCategorie;
    }


    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO groupe (idGroupe, code, actif, nbJoueur, nbQuestion, tempsReponse, commencer, idCategorie) values(default, :code, :actif, :nbJoueur, :nbQuestion, :tempsReponse, :commencer, :idCategorie)");
        $req->bindParam(":code", $data["code"]);
        $req->bindParam(":actif", $data["actif"]);
        $req->bindParam(":nbJoueur", $data["nbJoueur"]);
        $req->bindParam(":nbQuestion", $data["nbQuestion"]);
        $req->bindParam(":tempsReponse", $data["tempsReponse"]);
        $req->bindParam(":commencer", $data["commencer"]);
        $req->bindParam(":idCategorie", $data["idCategorie"]);
        $req->execute();
        return $db->lastInsertId();  

    }

    public static function read(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idGroupe, code, actif, nbJoueur, nbQuestion, tempsReponse, commencer, idCategorie FROM groupe WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetch();
        return $groupe;
    }

    public static function update(int $idGroupe, array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("UPDATE groupe SET code = :code, actif = :actif, nbJoueur = :nbJoueur, nbQuestion = :nbQuestion, tempsReponse = :tempsReponse, commencer = :commencer, idCategorie = :idCategorie WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->bindParam(":code", $data["code"]);
        $req->bindParam(":actif", $data["actif"]);
        $req->bindParam(":nbJoueur", $data["nbJoueur"]);
        $req->bindParam(":nbQuestion", $data["nbQuestion"]);
        $req->bindParam(":tempsReponse", $data["tempsReponse"]);
        $req->bindParam(":commencer", $data["commencer"]);
        $req->bindParam(":idCategorie", $data["idCategorie"]);
        $req->execute();
    }

    public static function delete(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM groupe WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idGroupe, code, actif, nbJoueur, nbQuestion, tempsReponse, commencer, idCategorie FROM groupe");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function codeExist(string $code)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idGroupe FROM groupe WHERE code = :code");
        $req->bindParam(":code", $code);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetch();
        return $groupe;
    }

    public static function updateCommencer(int $bool, int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("UPDATE groupe SET commencer = :commencer WHERE idGroupe = :idGroupe");
        $req->bindParam(":commencer", $bool);
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }

    public static function updateActif(int $bool, int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("UPDATE groupe SET actif = :actif WHERE idGroupe = :idGroupe");
        $req->bindParam(":actif", $bool);
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }
}
