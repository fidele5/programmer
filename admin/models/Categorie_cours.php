<?php
    require_once 'config.php';
    class Categorie_cours extends Config
    {
        public $id;
        public $nom;

        public function __construct() {
        }

        public function select()
        {
            $connexion = $this->GetConnexion();
            $query = 'SELECT * FROM categorie_cours';
            $requete = $connexion->prepare($query);
            $requete->execute();
            $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
            $requete->closeCursor();
            return $datas;

        }
    }
    