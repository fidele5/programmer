<?php
require_once 'config.php';
class Cours extends Config
{
    public $id;
    public $intitule;
    public $volhoraire;
    public $promotions_id;
    public function __construct()
    {

    }
    public function insert($intitule, $volhoraire, $promotions_id)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO cours(intitule, volhoraire, promotions_id) VALUES(:intitule, :volhoraire, :promotions_id)';
        $requete = $connexion->prepare($query);
        $requete->bindValue(":intitule", $intitule);
        $requete->bindValue(":volhoraire", $volhoraire);
        $requete->bindValue(":promotions_id", $promotions_id);
        $requete->execute();
        $id = $connexion->lastInsertId();
        $requete->closeCursor();
        return $id;
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function selectGrouped()
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT count(*), nom FROM programator.cours AS a INNER JOIN
                        programator.categorie_cours AS b ON a.categorie_id = b.id
                        GROUP BY categorie_id;";
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM cours WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function select_by_category($id_category){
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours WHERE categorie_id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id_category);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;

    }
}
