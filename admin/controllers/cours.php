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
        $fichier = (isset($_FILES)) ? $_FILES : null;
        $cours = new Cours($fichier);
        $domaine = $cours->upload();
        $cours->saveCourses($domaine);
        echo "ok";
        break;
    case "add":
        $fichier = (isset($_FILES)) ? $_FILES : null;
        $cours = new Cours($fichier);
        $cours->insert($intitule, $volhor, $promotion, $categorie, $details);
        echo "ok";
        break;
    case "delete":
        $cours = new Cours(null);
        $delete = $cours->delete($id);
        echo "deleted";
        break;
    case "modifier":
        $cours = new Cours(null);
        $updates = $cours->update($champs[0], $champs[1], $champs[2], $champs[3], $id);
        echo "ok";
    break;
    default:
        break;
}
