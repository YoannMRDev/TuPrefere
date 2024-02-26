<?php

namespace Core\Models;

use Core\Models\Model;

use PDO;
use Core\Session;

class Utilisateur extends Model
{
    protected int $idUtilisateur;
    protected string $pseudo;
    protected string $email;
    protected string $mdp;

    public function __construct($idUtilisateur = 0, $pseudo = "", $email = "", $mdp = "")
    {
        $this->$idUtilisateur = $idUtilisateur;
        $this->$pseudo = $pseudo;
        $this->$email = $email;
        $this->$mdp = $mdp;
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

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo)
    {
        $this->$pseudo = $pseudo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->$email = $email;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp)
    {
        $this->$mdp = $mdp;
    }

    #endregion getters/setters

    public static function create(array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("INSERT INTO utilisateur (idUtilisateur, pseudo, email, mdp) values(default, :pseudo, :email, :mdp)");
        $req->bindParam(":pseudo", $data["pseudo"]);
        $req->bindParam(":email", $data["email"]);
        $req->bindParam(":mdp", $data["mdp"]);
        $req->execute();
        return $db->lastInsertId();  
    }

    public static function read(int $idUtilisateur)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, pseudo, email, mdp FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateur = $req->fetch();
        return $utilisateur;
    }

    public static function update(int $idUtilisateur, array $data)
    {
        $db = static::getDB();
        $req = $db->prepare("UPDATE utilisateur SET pseudo = :pseudo, email = :email, mdp = :mdp WHERE idUtilisateur = :idUtilisateur");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->bindParam(":pseudo", $data["pseudo"]);
        $req->bindParam(":email", $data["email"]);
        $req->bindParam(":mdp", $data["mdp"]);
        $req->execute();
    }

    public static function delete(int $idUtilisateur)
    {
        $db = static::getDB();
        $req = $db->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :idUtilisateur");
        $req->bindParam(":idUtilisateur", $idUtilisateur);
        $req->execute();
    }

    public static function searchEmail(string $email)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur FROM utilisateur WHERE email = :email");
        $req->bindParam(":email", $email);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateur = $req->fetch();
        return $utilisateur;
    }

    public static function searchUtilisateur(string $email)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, mdp FROM utilisateur WHERE email = :email");
        $req->bindParam(":email", $email);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateur = $req->fetch();
        return $utilisateur;
    }

    public static function getAll()
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT idUtilisateur, pseudo, email, mdp FROM utilisateur");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateurs = $req->fetchAll();
        return $utilisateurs;
    }

    public static function getAllUserofGroup(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT u.idUtilisateur, u.pseudo FROM utilisateur as u JOIN groupe_utilisateur as gu ON (gu.idUtilisateur = u.idUtilisateur) WHERE gu.idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $utilisateurs = $req->fetchAll();
        return $utilisateurs;
    }

    public static function getCountOfAllUserOfGroup(int $idGroupe)
    {
        $db = static::getDB();
        $req = $db->prepare("SELECT COUNT(u.idUtilisateur) as count FROM utilisateur as u JOIN groupe_utilisateur as gu ON (gu.idUtilisateur = u.idUtilisateur) WHERE gu.idGroupe = :idGroupe");
        $req->bindParam(":idGroupe", $idGroupe);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $count = $req->fetch();
        return $count;
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
