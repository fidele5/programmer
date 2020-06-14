<?php
    require_once "config.php";
    class Settings extends Config{
        private $id, $nom, $min, $max;

        public function __construct() {
            
        }

        
        public function selectByName($name)
        {
            $connexion = $this->GetConnexion();
            $query = "SELECT * FROM settings WHERE designation =:nom";
            $requete = $connexion->prepare($query);
            $requete->bindValue(':nom', $name);
            $requete->execute();
            $datas = $requete->fetchALL(PDO::FETCH_ASSOC);
            $requete->closeCursor();
            return $datas;
        }

        public function update($min, $max){
            $connexion = $this->GetConnexion();
            $query = "UPDATE settings SET minimum = :minim, maximum = :maxim WHERE designation = :nom";
            $requete = $connexion->prepare($query);
            $requete->bindValue(':nom', $name);
            $requete->bindValue(':minim', $min);
            $requete->bindValue(':maxim', $max);
            $requete->execute();
            $requete->closeCursor();
        }
    }
    