<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/programmer/admin/vendor/autoload.php';
require_once 'config.php';
require_once 'domaines.php';
require_once 'categories.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Utilisateurs extends Config
{
    public $id;
    public $nom_complet;
    public $login;
    public $password;
    public $email;
    public $file;
    public const PATH = '../files/';
    public $spreadsheet;
    public $Reader;
    public $cours;
    public $domaines;
    public $categories;

    public function __construct()
    {
        $file = func_get_args()[0];
        $this->file = $file;
        $this->spreadsheet = new Spreadsheet();
        $this->Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $this->domaines = new Domaines();
        $this->categories = new Categories();
    }

    public function insert($nom_complet, $login, $password, $email, $categorie_id, $domaine_id)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO utilisateurs(nom_complet, login, password, email, categorie_id, domaine_id) VALUES(:nom_complet, :login, :password, :email, :categorie_id, :domaine_id)';
        $requete = $connexion->prepare($query);
        $requete->bindValue(":nom_complet", $nom_complet);
        $requete->bindValue(":login", $login);
        $requete->bindValue(":password", $password);
        $requete->bindValue(":email", $email);
        $requete->bindValue(":categorie_id", $categorie_id);
        $requete->bindValue(":domaine_id", $domaine_id);
        $requete->execute();
        $id = $connexion->lastInsertId();
        $requete->closeCursor();
        return $id;
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT utilisateurs.id AS id, nom_complet, login, email, password,  categories.nom AS categorie, domaines.nom AS domaine FROM utilisateurs
                    INNER JOIN categories ON utilisateurs.categorie_id  = categories.id
                    INNER JOIN domaines ON utilisateurs.domaine_id = domaines.id';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function update($nom, $login, $password, $email, $categorie_id, $domainr_id, $formation, $id)
    {
        $connexion = $this->GetConnexion();
        $query = "UPDATE utilisateurs 
                  SET nom_complet = :nom, login = :lg, password = :psw, email = :email, 
                      categorie_id = :cat, domaine_id = :domain, formation = :form
                  WHERE id = :id";
        $requete = $connexion->prepare($query);
        $requete->bindValue(':nom', $nom);
        $requete->bindValue(':lg', $login);
        $requete->bindValue(':psw', $password);
        $requete->bindValue(':email', $email);
        $requete->bindValue(':cat', $categorie_id);
        $requete->bindValue(':domain', $domainr_id);
        $requete->bindValue(':form', $formation);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function upload()
    {
        foreach ($this->file as $file) {
            $extensions_valides = array('xls', 'xlsx', 'csv', 'sql');
            $text = substr(strrchr($file['name'], '.'), 1);
            if (in_array($text, $extensions_valides)) {
                $tmp_name = $file['tmp_name'];
                $file['name'] = explode(".", $file['name']);
                $file['name'] = $file['name'][0] . "." . $text;
                $destination = $this::PATH . $file['name'];
                move_uploaded_file($tmp_name, $destination);
            }
            if ($file['error'] == UPLOAD_ERR_OK) {
                $this->file_path = $destination;
            }
        }
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM utilisateurs WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM utilisateurs WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function Login($mdp, $login)
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT id, nom_complet FROM utilisateurs WHERE password = :mdp AND login = :log";
        $requete = $connexion->prepare($query);
        $requete->bindValue(":mdp", $mdp);
        $requete->bindValue(":log", $login);
        $requete->execute();
        $data = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $data;
    }

    public function Save()
    {
        if (file_exists($this->file_path)) {
            $spreadSheet = $this->Reader->load($this->file_path);
            $sheetCount = $spreadSheet->getSheetCount();
            $domains = array("SI" => "Genie Logiciel",
                             "GST" => "Management", 
                             "DSG" => "Design", 
                             "TLC" => "Telecom", 
                             "RES" => "Reseaux", 
                             "G1" => "Generale", 
                             "prepa" => "Generale");
            for ($i = 0; $i < $sheetCount; $i++) {
                $nom = $spreadSheet->getSheetNames();
                $sheet = $spreadSheet->getSheet($i);
                $sheetData = $sheet->toArray();
                $prom = $nom[$i];
                $filiere = explode(' ', $prom);

                foreach ($sheetData as $key => $value) {
                    if ($key == 0) {
                        continue;
                    } else {
                        $nom = $value[2] . " " . $value[3] . " " . $value[4];
                        $email = strtolower($value[1]) . "@esisalama.org";
                        $password = self::generatePassword();
                        $domaine = $this->domaines->select_by_name($domains[$filiere[1]]);
                        $cat = $this->categories->select_id_by_name("Etudiant");

                        if (!$this->exists($email)) {
                            $ajouter = $this->insert($nom, $email, $password, $email, $cat, $domaine[0]['id']);
                        }
                        else{
                            continue;
                        }
                    }
                }
            }

        } else {
            echo "une erreur s'est produite";
        }

    }

    public static function generatePassword(){
        $chiffres = 6;
        $i = 0;
        while ($i < $chiffres) {
            $nbres = mt_rand(0, 9);
            $nbr[$i] = $nbres;
            $i++;
        }

        $nombres = null;

        foreach ($nbr as $key) {
            $nombres .= $key;
        }
        $mdp = $nombres;
        return $mdp;

    }

    public function exists($email){
        $connexion = $this->GetConnexion();
        $query = "SELECT COUNT(*) FROM utilisateurs WHERE email = :email";
        $requete = $connexion->prepare($query);
        $requete->bindValue(":email", $email);
        $requete->execute();
        $exists = ($requete->fetchColumn() == 0)?false:true;
        $requete->closeCursor();
        return $exists;
    }
}
