<?php
require_once 'config.php';
class Utilisateurs extends Config
{
    public $id;
    public $nom_complet;
    public $login;
    public $password;
    public $email;
    public $categorie_id;
    public $domaine_id;
    public function __construct()
    {

    }
    public function insert($nom_complet, $login, $password, $email, $categorie_id, $domaine_id)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO utilisateurs(nom_complet, login, password, email, categorie_id, domaine_id) VALUES(:nom_complet, :login, :password, :email, :categorie_id, :domaine_id)';
        $requete = $connexion->prepare($query);
        $requete->bindValue(":nom_complet", $nom_complet);
        $requete->bindValue(":login", $login);
        $requete->bindValue(":password", $password);
        $requete->bindValue(":email", $email);
        $requete->bindValue(":categorie_id", $categorie_id);
        $requete->bindValue(":domaine_id", $domaine_id);
        $requete->execute();
        $id = $connexion->lastInsertId();
        $requete->closeCursor();
        return $id;
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT nom_complet, login, email, categories.nom AS categorie, domaines.nom AS domaine FROM utilisateurs 
                    INNER JOIN categories ON utilisateurs.categorie_id  = categories.id 
                    INNER JOIN domaines ON utilisateurs.domaine_id = domaines.id';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM utilisateurs WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM utilisateurs WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function Login($mdp, $login)
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT id, nom_complet FROM utilisateurs WHERE password = :mdp AND login = :log";
        $requete = $connexion->prepare($query);
        $requete->bindValue(":mdp", $mdp);
        $requete->bindValue(":log", $login);
        $requete->execute();
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $data;
    }

}
