<?php
session_start();
require_once "models/autoload.php";
function is_connected()
{
    if (isset($_SESSION["id"]) && isset($_SESSION["login"])) {
        return true;
    } else {
        return false;
    }

}

function Login($page)
{
    require_once 'views/login.php';
}

function Logout()
{
    session_destroy();
    unset($_SESSION);
    header('location: index.php');
}

function Signup($page)
{
    require_once "views/signin.php";
}

function Users($page)
{
    $user = new Utilisateurs;
    $categories = new Categories();
    $domaines = new Domaines();
    $users = $user->select();
    require_once 'views/utilisateurs.php';
}

function Upload($page){
    require_once "views/upload.php";
}

function Votes($page)
{
    require_once 'views/votes.php';
}

function Programmes($page)
{
    require_once "controllers/compiler.php";
    //include "exports.php";
    $id_filiere = $_GET["id"];
    $fil = new Domaines();
    $nom_fil = $fil->select_by_id($id_filiere)[0]["nom"];
    $compiler = new Compiler($id_filiere);
    $compiler->compile();
    $programme = $compiler->getFullFinalProgram();
    //exportToExcel($programme, $nom_fil);
    require_once 'views/programmes.php';
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
