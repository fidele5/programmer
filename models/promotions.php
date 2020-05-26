<?php
require_once 'config.php';
class Promotions extends Config
{
    public $id;
    public $designation;
    public $domaines_id;
    public function __construct()
    {

    }
    public function insert($designation, $domaines_id)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO promotions(designation, domaines_id) VALUES(:designation, :domaines_id)';
        $requete = $connexion->prepare($query);

        $requete->bindValue(":designation", $designation);
        $requete->bindValue(":domaines_id", $domaines_id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM promotions';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll();
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM promotions WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM promotions WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll();
        $requete->closeCursor();
        return $datas;
    }

}
