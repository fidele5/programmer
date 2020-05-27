<?php

require_once 'config.php';

class Votes extends Config
{
    public $id;
    public $utilisateurs_id;
    public $cours_id;
    public $promotions_id;
    public function __construct()
    {

    }
    public function insert($utilisateurs_id, $cours_id, $promotions_id, $ponderation, $selected)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO votes(utilisateurs_id, cours_id, promotions_id, ponderation, selected) VALUES(:utilisateurs_id, :cours_id, :promotions_id, :ponderation, :selected)';
        $requete = $connexion->prepare($query);
        $requete->bindValue(":utilisateurs_id", $utilisateurs_id);
        $requete->bindValue(":cours_id", $cours_id);
        $requete->bindValue(":promotions_id", $promotions_id);
        $requete->bindValue(":ponderation", $ponderation);
        $requete->bindValue(":selected", $selected);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM votes';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM votes WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM votes WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }
}
