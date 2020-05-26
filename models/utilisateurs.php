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
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM utilisateurs';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll();
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
        $datas = $requete->fetchAll();
        $requete->closeCursor();
        return $datas;
    }

}
