<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Categorie extends Model
{
    protected int $idCategorie;
    protected string $nom;
    protected bool $archiver;

    public function __construct($idCategorie = 0, $nom = "", $archiver = false)
    {
        $this->$idCategorie = $idCategorie;
        $this->$nom = $nom;
        $this->$archiver = $archiver;
    }

    #region getters/setters

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(int $idCategorie)
    {
        $this->$idCategorie = $idCategorie;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->$nom = $nom;
    }

    public function getArchiver()
    {
        return $this->archiver;
    }

    public function setArchiver(bool $archiver)
    {
        $this->$archiver = $archiver;
    }

    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO categorie (idUtilisateur, nom, archiver) values(default, :nom, :archiver)");
        $req->bindParam(":nom", $data["nom"]);
        $req->bindParam(":archiver", $data["archiver"]);
        $req->execute();
        return $db->lastInsertId();  
    }

    public static function read(int $idCategorie)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idCatgorie, nom, archiver FROM categorie WHERE idCategorie = :idCategorie");
        $req->bindParam(":idCategorie", $idCategorie);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateur = $req->fetch();
        return $utilisateur;
    }

    public static function update(int $idCategorie, array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("UPDATE categorie SET nom = :nom, archiver = :archiver WHERE idCategorie = :idCategorie");
        $req->bindParam(":idCategorie", $idCategorie);
        $req->bindParam(":nom", $data["nom"]);
        $req->bindParam(":archiver", $data["archiver"]);
        $req->execute();
    }

    public static function delete(int $idUtilisateur)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM categorie WHERE idCategorie = :idCategorie");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->execute();
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idCategorie, nom, archiver FROM categorie");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateurs = $req->fetchAll();
        return $utilisateurs;
    }

    public static function authenticate() {
        // Session::init();
        if (Session::userIsLoggedIn() === false) {
            return false;
        } else {
            return true;
        }
        return false;
    }
}
