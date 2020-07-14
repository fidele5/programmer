<?php

require_once 'config.php';

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
    
    
    public function __construct()
    {
        $this->file = func_get_args()[0];
        $this->spreadsheet = new Spreadsheet();
        $this->Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
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

    public function saveCourses()
    {
        if (file_exists($this->file_path)) {
            $spreadSheet = $this->Reader->load($this->file_path);
            $sheetCount = $this->spreadsheet->getSheetCount();
            for ($i = 0; $i < $sheetCount; $i++) {
                $nom = $spreadSheet->getSheetNames();
                $sheet = $spreadSheet->getSheet($i);
                $sheetData = $sheet->toArray();
                $prom = $nom[$i];
                foreach ($sheetData as $key => $value) {
                    if ($key == 0) {
                        continue;
                    } else {
                        $promotions = $this->promotion->select_id_by_name_domain($prom, $value[2]);
                        $cat = $this->categories->getCatByName($value[2]);
                        $this->insert($value[0], $value[1], $promotions['id'], $cat);
                    }
                }

            }

        } else {
            echo "une erreur s'est produite";
        }

    }
}