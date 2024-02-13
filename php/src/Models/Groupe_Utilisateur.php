<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Groupe_Utilisateur extends Model
{
    protected int $idUtilisateur;
    protected string $idGroupe;

    public function __construct($idUtilisateur = "", $idGroupe = "")
    {
        $this->$idUtilisateur = $idUtilisateur;
        $this->$idGroupe = $idGroupe;
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

    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO groupe_utilisateur (idUtilisateur, idGroupe) values(:idUtilisateur, :idGroupe)");
        $req->bindParam(":idUtilisateur", $data["idUtilisateur"]);
        $req->bindParam(":idGroupe", $data["idGroupe"]);
        $req->execute();
        return $db->lastInsertId();  

    }

    public static function read(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, idGroupe FROM groupe_utilisateur WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetch();
        return $groupe;
    }

    public static function delete(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM groupe_utilisateur WHERE idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->execute();
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, idGroupe FROM groupe_utilisateur");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function getGroupeByUtilisateur(int $idUtilisateur)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT g.idGroupe, g.code, g.actif, g.nbJoueur, g.nbQuestion, g.tempsReponse, g.idCategorie, c.nom FROM groupe_utilisateur as gu JOIN utilisateur as u ON (gu.idUtilisateur = u.idUtilisateur) JOIN groupe as g ON (gu.idGroupe = g.idGroupe) JOIN categorie as c ON (c.idCategorie = g.idCategorie) WHERE u.idUtilisateur = :idUtilisateur");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $groupe = $req->fetchAll();
        return $groupe;
    }

    public static function deleteByUtilisateur(int $idUtilisateur)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM groupe_utilisateur WHERE idUtilisateur = :idUtilisateur");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->execute();
    }
}
