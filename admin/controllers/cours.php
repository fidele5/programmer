<?php
session_start();
require_once '../models/cours.php';

if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {
    case "ajouter":
        $fichier = (isset($_FILES))?$_FILES:null;
        $cours = new Cours($fichier);
        // $cours->upload();
        // $cours->saveCourses();
        echo "ok";
        break;
    case "delete":
        $cours = new Cours($_FILES);
        $id = $_GET["id"];
        $delete = $cours->delete($id);
        header("location: ../cours");
        break;
    default:
        break;
}
