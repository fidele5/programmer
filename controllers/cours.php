<?php
session_start();
require_once '../models/cours.php';
$cours = new Cours();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {
    case "ajouter":
        $vals = array();
        foreach ($data as $key => $value) {
            extract($value);
            $ajouter = $cours->insert($intitule, $volume, 1);
            if ($ajouter > 0) {
            $datas = array("label" => $intitule, "state" => "suggested", "id" => $ajouter);
            array_push($vals, $datas);
            } else {
                continue;
            }
        }
        if (!isset($_SESSION['suggested'])) {
            $_SESSION['suggested'] = array();
        }
        array_push($_SESSION['suggested'], array($promotion=>$vals));
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
