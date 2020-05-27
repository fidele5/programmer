<?php
require_once 'config.php';
class Admins extends Config
{
    public $id;
    public $login;
    public $mdp;
    public function __construct()
    {

    }
    public function insert($login, $mdp)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO admins(login, mdp) VALUES(:login, :mdp)';
        $requete = $connexion->prepare($query);

        $requete->bindValue(":login", $login);
        $requete->bindValue(":mdp", $mdp);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM admins';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function update($id, $login, $mdp)
    {
        $connexion = $this->GetConnexion();
        $query = 'UPDATE admins SET login =:login, mdp =:mdp WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);

        $requete->bindValue(":login", $login);
        $requete->bindValue(":mdp", $mdp);
        $requete->execute();
        $requete->closeCursor();
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM admins WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM admins WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function Login($mdp)
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT id, login FROM admins WHERE mdp = :mdp";
        $requete = $connexion->prepare($query);
        $requete->bindValue(":mdp", $mdp);
        $requete->execute();
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $data;
    }
}
