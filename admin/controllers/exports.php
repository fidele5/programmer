<?php 
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportToExcel(array $cours, $filiere_name)
{
    $spreadsheet = new Spreadsheet();
    $feuille = 0;
    foreach($cours as $promotion => $courses)
    {
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $promotion);

        $myWorkSheet->getCell("A1")->setValue("Intitule");
        $myWorkSheet->getCell("B1")->setValue("Volume horaire");
        $myWorkSheet->getCell("C1")->setValue("Categorie");

        $lignes = 2;
        $nb_cours = count($courses);
        for($i = 0; $i < $nb_cours; $i++)
        {
            $myWorkSheet->setCellValueByColumnAndRow(1, $lignes, $courses[$i]["intitule"]);
            $myWorkSheet->setCellValueByColumnAndRow(2, $lignes, $courses[$i]["volhoraire"]);
            $myWorkSheet->setCellValueByColumnAndRow(3, $lignes, $courses[$i]["categorie_id"]);
            $lignes++;
        }

        // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
        $spreadsheet->addSheet($myWorkSheet, $feuille);
        $feuille++;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($filiere_name.'.xlsx');
}
