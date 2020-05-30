<?php
require_once 'config.php';
class Cours extends Config
{
    public $id;
    public $id_cours;
    public $id_etudiant;
    public $moyenne;
    public $examen;
    public function __construct()
    {

    }
    public function insert($idCours, $idEtudiant, $moyenne, $examen)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO cotes_users VALUES(NULL, :idCours, :idEtudiant, :moyenne, :examen)';
        $requete = $connexion->prepare($query);
        $requete->bindValue(":idCours", $idCours);
        $requete->bindValue(":idEtudiant", $idEtudiant);
        $requete->bindValue(":moyenne", $moyenne);
        $requete->bindValue(":examen", $examen);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cotes_users';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM cotes_users WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cotes_users WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function select_by_user_and_course($idUser, $idCourse)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cotes_users WHERE id_etudiant = :idUser AND id_cours = :idCourse';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':idUser', $idUser);
        $requete->bindValue(':idCourse', $idCourse);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

}