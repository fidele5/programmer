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
        $query = 'INSERT INTO votes(utilisateur_id, cours_id, promotion_id, ponderation, selected) VALUES(:utilisateurs_id, :cours_id, :promotions_id, :ponderation, :selected)';
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

    public function update_votes($idUser)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM votes WHERE utilisateur_id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $idUser);
        $requete->execute();
        $requete->closeCursor();
    }

    public function votes_filiere($idFiliere)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM votes WHERE utilisateur_id IN (SELECT id FROM utilisateurs WHERE domaine_id = :idFiliere) ';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':idFiliere', $idFiliere);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function nombre_participant($idFiliere)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT COUNT(*) as nombre FROM (SELECT DISTINCT utilisateur_id FROM votes WHERE utilisateur_id IN(
            SELECT id FROM utilisateurs WHERE domaine_id = :idFiliere)) AS UTIL';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':idFiliere', $idFiliere);
        $requete->execute();
        $datas = $requete->fetchColumn();
        $requete->closeCursor();
        return $datas;
    }

    public function get_votes_participant($utilisateur_id)
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT cours_id, intitule, designation FROM votes INNER JOIN cours ON votes.cours_id = cours.id INNER JOIN promotions ON cours.promotions_id = promotions.id WHERE utilisateur_id = :id";
        $requete = $connexion->prepare($query);
        $requete->bindValue(":id", $utilisateur_id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }
}
