<?php
session_start();
require_once '../models/cours.php';
require_once '../models/promotions.php';
$cours = new Cours();
$promotions = new Promotions();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {
    case "ajouter":
        if (!isset($_SESSION['suggested'])) {
            $_SESSION['suggested'] = array(
                "prepa" => array(),
                "G1" => array(),
                "G2" => array(),
                "G3" => array()
            );

        }
        foreach ($data as $key => $value) {
            extract($value);
            $prom = $promotions->select_by_name($promotion);
            $exists = ($cours->exists($intitule) == 0)?false:true;
            if (!$exists) {
               $ajouter = $cours->insert($intitule, $volume, $prom, $categorie, 1);
                if ($ajouter > 0) {
                    $datas = array("label" => $intitule, "state" => "suggested", "id" => $ajouter);
                    array_push($_SESSION['suggested'][$promotion], $datas);
                } else {
                    continue;
                }

            }
            else echo $intitule." exists";
        }
        echo "ok";
        break;
    case "delete":
        $id = $_GET["id"];
        $delete = $cours->delete($id);
        header("location: ../cours");
        break;
    default:
        break;
}
