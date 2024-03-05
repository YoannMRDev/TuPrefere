<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Groupe_Question extends Model
{
    protected int $idGroupe;
    protected int $idQuestion;

    public function __construct($idGroupe = "", $idQuestion = "")
    {
        $this->$idGroupe = $idGroupe;
        $this->$idQuestion = $idQuestion;
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

    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion)
    {
        $this->$idQuestion = $idQuestion;
    }

    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO groupe_question (idGroupe, idQuestion) values(:idGroupe, :idQuestion)");
        $req->bindParam(":idGroupe", $data["idGroupe"]);
        $req->bindParam(":idQuestion", $data["idQuestion"]);
        $req->execute();
        return $db->lastInsertId();
    }

    public static function read(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion, idGroupe FROM groupe_question WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function delete(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM groupe_question WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion, idGroupe FROM groupe_question");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function getAllQuestionByGroup(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion FROM groupe_question WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }
}
