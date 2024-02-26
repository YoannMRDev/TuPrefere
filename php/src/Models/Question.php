<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Question extends Model
{
    protected int $idQuestion;
    protected string $choix1;
    protected string $choix2;
    protected bool $archiver;
    protected int $idCategorie; 

    public function __construct($idQuestion = 0, $choix1 = "", $choix2 = "", $archiver = false, $idCategorie = 0)
    {
        $this->$idQuestion = $idQuestion;
        $this->$choix1 = $choix1;
        $this->$choix2 = $choix2;
        $this->$archiver = $archiver;
        $this->$idCategorie = $idCategorie;
    }

    #region getters/setters

    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    public function setIdQuestion(int $idQuestion)
    {
        $this->$idQuestion = $idQuestion;
    }

    public function getChoix1()
    {
        return $this->choix1;
    }

    public function setChoix1(string $choix1)
    {
        $this->$choix1 = $choix1;
    }

    public function getChoix2()
    {
        return $this->choix2;
    }

    public function setChoix2(string $choix2)
    {
        $this->$choix2 = $choix2;
    }

    public function getArchiver()
    {
        return $this->archiver;
    }

    public function setArchiver(bool $archiver)
    {
        $this->$archiver = $archiver;
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
        $req = $db->prepare("INSERT INTO question (idQuestion, choix1, choix2, archiver, idCategorie) values(default, :choix1, :choix2, :archiver, :idCategorie)");
        $req->bindParam(":choix1", $data["choix1"]);
        $req->bindParam(":choix2", $data["choix2"]);
        $req->bindParam(":archiver", $data["archiver"]);
        $req->bindParam(":idCategorie", $data["idCategorie"]);
        $req->execute();
        return $db->lastInsertId();  
    }

    public static function read(int $idQuestion)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion, choix1, choix2, archiver, idCategorie FROM question WHERE idQuestion = :idQuestion");
        $req->bindParam(":idQuestion", $idQuestion);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $question = $req->fetch();
        return $question;
    }

    public static function readByCategorie(int $idCategorie)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion, choix1, choix2, archiver, idCategorie FROM question WHERE idCategorie = :idCategorie");
        $req->bindParam(":idCategorie", $idCategorie);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $question = $req->fetchAll();
        return $question;
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idQuestion, choix1, choix2, archiver, idCategorie FROM question");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $questions = $req->fetchAll();
        return $questions;
    }
}
