<?php
require_once "config.php";
class Settings extends Config
{
    private $id, $nom, $min, $max;

    public function __construct()
    {

    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT * FROM settings";
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchALL(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas[0];
    }

    public function update($cotation, $moyenne)
    {
        $connexion = $this->GetConnexion();
        $query = "UPDATE settings SET ponderation = :cotation, moyenne = :moyenne WHERE 1";
        $requete = $connexion->prepare($query);
        $requete->bindValue(':cotation', $cotation);
        $requete->bindValue(':moyenne', $moyenne);
        $requete->execute();
        $requete->closeCursor();
    }
}
