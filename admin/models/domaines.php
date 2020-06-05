
<?php
require_once 'config.php';
class Domaines extends Config
{
    public $id;
    public $nom;
    public function __construct()
    {

    }
    public function insert($nom)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO domaines(nom) VALUES(:nom)';
        $requete = $connexion->prepare($query);

        $requete->bindValue(":nom", $nom);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM domaines';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll();
        $requete->closeCursor();
        return $datas;
    }

    public function update($id, $nom)
    {
        $connexion = $this->GetConnexion();
        $query = 'UPDATE domaines SET nom =:nom WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);

        $requete->bindValue(":nom", $nom);
        $requete->execute();
        $requete->closeCursor();
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM domaines WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM domaines WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll();
        $requete->closeCursor();
        return $datas;
    }

}