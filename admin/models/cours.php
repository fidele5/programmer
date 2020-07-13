<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/programmer/admin/vendor/autoload.php';
require_once 'config.php';
require_once 'promotions.php';
require_once 'Categorie_cours.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Cours extends Config
{
    public $id;
    public $intitule;
    public $volhoraire;
    public $promotions_id;
    public $file;
    public const PATH = '../files/';
    public $spreadsheet;
    public $Reader;
    public $cours;
    public $promotion;
    public $categories;

    public function __construct()
    {
        $file = func_get_args()[0];
        $this->file = $file;
        $this->spreadsheet = new Spreadsheet();
        $this->Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $this->promotion = new Promotions();
        $this->categories = new Categorie_cours();
    }

    public function insert($intitule, $volhoraire, $promotions_id, $categorie)
    {
        $connexion = $this->GetConnexion();
        $query = 'INSERT INTO cours(intitule, volhoraire, promotions_id) VALUES(:intitule, :volhoraire, :promotions_id)';
        $requete = $connexion->prepare($query);

        $requete->bindValue(":intitule", $intitule);
        $requete->bindValue(":volhoraire", $volhoraire);
        $requete->bindValue(":promotions_id", $promotions_id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select()
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours';
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function selectGrouped()
    {
        $connexion = $this->GetConnexion();
        $query = "SELECT count(*), nom FROM programator.cours AS a INNER JOIN
                        programator.categorie_cours AS b ON a.categorie_id = b.id
                        GROUP BY categorie_id;";
        $requete = $connexion->prepare($query);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function delete($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'DELETE FROM cours WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $requete->closeCursor();
    }

    public function select_by_id($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours WHERE id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function select_by_category($id_category)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours WHERE categorie_id = :id';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id_category);
        $requete->execute();
        $datas = $requete->fetchAll(PDO::FETCH_ASSOC);
        $requete->closeCursor();
        return $datas;
    }

    public function select_by_id_filiere($id)
    {
        $connexion = $this->GetConnexion();
        $query = 'SELECT * FROM cours WHERE promotions_id IN (SELECT id FROM promotions WHERE domaines_id = :id OR domaines_id IN (SELECT id FROM domaines WHERE nom="Generale"))';
        $requete = $connexion->prepare($query);
        $requete->bindValue(':id', $id);
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
                        $ajouter = $this->insert($value[0], $value[1], $promotions['id'], $cat);
                    }
                }

            }

        } else {
            echo "une erreur s'est produite";
        }

    }
}
