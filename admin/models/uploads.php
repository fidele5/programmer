<?php
    require '../vendor/autoload.php';
    require_once 'cours.php';
    require_once 'promotions.php';
    require_once 'Categorie_cours.php';


    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    class Uploads
    {
        public $file;
        public const PATH = '../files/';
        public $spreadsheet;
        public $Reader;
        public $cours;
        public $promotion;
        public $categories;

        
        public function __construct($file) {
            $this->file = $file;
            $this->spreadsheet = new Spreadsheet();
            $this->Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $this->cours = new Cours();
            $this->promotion = new Promotions();
            $this->categories = new Categorie_cours();

        }

        public function upload(){
            foreach ($this->file as $file) {
                $extensions_valides = array('xls', 'xlsx', 'csv', 'sql');
                $text = substr(strrchr($file['name'], '.'), 1);
                if (in_array($text, $extensions_valides)) {
                    $tmp_name = $file['tmp_name'];
                    $file['name'] = explode(".", $file['name']);
                    $file['name'] = $file['name'][0] . "." . $text;
                    $destination = $this::PATH.$file['name'];
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
                            $ajouter = $this->cours->insert($value[0], $value[1], $promotions['id'], $cat);
                        }
                    }

                }


            } else {
                echo "une erreur s'est produite";
            }

        }

    }
    