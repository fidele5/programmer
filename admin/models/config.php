
<?php
    class Config
    {
        const bd_nom_serveur = 'localhost';
        const bd_login = 'root';
        const bd_mot_de_passe = 'root';
        const bd_nom_bd = 'programator';

        public function __construct()
        {

        }

        private function ConnexionBdd()
        {
            try
            {
                $connexion = new PDO('mysql:host=' . $this::bd_nom_serveur.';dbname='.$this::bd_nom_bd,  $this::bd_login, $this::bd_mot_de_passe);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connexion;
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        public function GetConnexion()
        {
            return $this->ConnexionBdd();
        }
    }