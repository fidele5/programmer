<?php
session_start();
require_once '../models/utilisateurs.php';
$utilisateurs = new Utilisateurs();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {
    case "ajouter":
            $ajouter = $utilisateurs->insert($nom_complet, $login, $password, $email, $categorie_id, $domaine_id);
            $_SESSION['login'] = $nom_complet;
            $_SESSION['id'] = $ajouter;
            echo 'okay';
        break;

    case "login":
        $user = $utilisateurs->Login($password, $login);
        if (count($user) > 0) {
            $_SESSION['login'] = $user[0]['nom_complet'];
            $_SESSION['id'] = $user[0]['id'];
            echo 'okay';
        }
        else echo "ko";
    break;
    case "delete":
        $id = $_GET["id"];
        $delete = $utilisateurs->delete($id);
        header("location: ../utilisateurs");
        break;
    default:
        break;
}
