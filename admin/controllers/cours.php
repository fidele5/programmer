<?php
session_start();
require_once '../models/cours.php';
require_once '../models/uploads.php';

$cours = new Cours();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
$action = "ajouter";
switch ($action) {
    case "ajouter":
        $upload = new Uploads($_FILES);
        $upload->upload();
        $upload->saveCourses();
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
