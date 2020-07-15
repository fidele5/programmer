<?php

require_once 'config.php';
require_once 'Utilisateurs.php';
require_once 'cours.php';
require_once 'promotions.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Cotes extends Config
{
    public $id;
    public $id_cours;
    public $id_etudiant;
    public $moyenne;
    public $examen;
    public $file;
    public $spreadsheet;
    public $Reader;
    public $file_path;
    public $utilisateur;
    public $cours;
    public $promotions;
    public const PATH = '../files/';
    
    public function __construct()
    {
        $params = func_get_args();
        if(!empty($params)) $this->file = $params[0];
        $this->spreadsheet = new Spreadsheet();
        $this->Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $this->utilisateur = new Utilisateurs();
        $this->cours = new Cours();
        $this->promotions = new Promotions();
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

    public function update($idCours, $idEtudiant, $moyenne, $examen, $id)
    {
        $connexion = $this->GetConnexion();
        $query = 'UPDATE cotes_users SET id_cours = :idCours, id_etudiant = :idEtudiant, moyenne = :moyenne, examen = :examen WHERE id=:id';
        $requete = $connexion->prepare($query);

        $requete->bindValue(":idCours", $idCours);
        $requete->bindValue(":idEtudiant", $idEtudiant);
        $requete->bindValue(":moyenne", $moyenne);
        $requete->bindValue(":examen", $examen);
        $requete->bindValue(":id", $id);
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
        $query = sprintf('SELECT * FROM cotes_users WHERE id_etudiant = %d AND id_cours = %d', $idUser, $idCourse);
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
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

    public function Save()
    {
        if (file_exists($this->file_path)) {
            $spreadSheet = $this->Reader->load($this->file_path);
            $noms = $spreadSheet->getSheetNames();
            $sheet = $spreadSheet->getSheet(0);
            $sheetData = $sheet->toArray();
            $prom = $noms[0];
            $cours = $sheetData[0];
            $rows = count($sheetData);
            for ($i=1; $i<$rows; $i=$i+3) {
                $cotes_user = $sheetData[$i];
                $user = $cotes_user[0];
                for($j=1; $j < count($cotes_user); $j++) {
                    $nom_cours = $cours[$j];
                    $moyenne = $sheetData[$i][$j];
                    $examen = $sheetData[$i+1][$j];
                    $total = $sheetData[$i+2][$j];
                    $email = strtolower($user).'@esisalama.org';
                    $id_etudiant = $this->utilisateur->get_id_by_email($email);
                    if(empty($id_etudiant)) continue;
                    $idcours = $this->cours->select_id($nom_cours);
                    if(empty($idcours)) continue;
                    //$promotion = $this->promotions->select_id($prom);
                    $this->insert($idcours[0]['id'], $id_etudiant[0]['id'], $moyenne, $examen);
                }
            }
        } else {
            echo "une erreur s'est produite";
        }
    }
}