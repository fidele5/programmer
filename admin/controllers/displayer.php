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
    $user = new Utilisateurs(null);
    $categories = new Categories();
    $domaines = new Domaines();
    $users = $user->select();
    require_once 'views/utilisateurs.php';
}

function Upload($page)
{
    require_once "views/upload.php";
}

function Mailbox($page){
    $utilisateur = new Utilisateurs(null);
    $utilisateurs = $utilisateur->selectReceived();
    require_once "views/mailbox.php";
}

function Profile($page, $id){
    $users = new Utilisateurs(null);
    $user = $users->select_by_id($id);
    $categories = new Categories();
    $statuses = $categories->select();
    $domaine = new Domaines();
    $domaines = $domaine->select();
    require_once 'views/edit_profile.php';
}

function Settings($page)
{
    require_once "views/settings.php";
}

function Votes($page)
{
    require_once 'views/votes.php';
}

function Programmes($page)
{
    require_once "controllers/compiler.php";
    // include "exports.php";
    $id_filiere = $_GET["id"];
    $fil = new Domaines();
    $nom_fil = $fil->select_by_id($id_filiere)[0]["nom"];
    $compiler = new Compiler($id_filiere);
    $compiler->compile();
    $programme = $compiler->getFullFinalProgram();
    // exportToExcel($programme, $nom_fil);
    require_once 'views/programmes.php';
}

function UploadUser($page)
{
    require_once "views/upuser.php";
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
