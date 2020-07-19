<?php
session_start();
require_once "models/autoload.php";
function is_connected()
{
    if (isset($_SESSION["admin_id"]) && isset($_SESSION["admin_login"])) {
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

function Courses($page)
{
    $cours = new Cours(null);
    $courses = $cours->select();
    require_once "views/courses.php";
}

function Course($page)
{
    $promotion = new Promotions();
    $promotions = $promotion->select();
    $categorie = new Categorie_cours();
    $categories = $categorie->select();
    $cours = new Cours(null);
    
    require_once "views/addCourse.php";
}


function Signup($page)
{
    require_once "views/signin.php";
}

function Details($page, $id_cours)
{
    $vote = new Votes;
    $details = $vote->select_details_vote($id_cours);
    $cours = new Cours(null);
    $cour = $cours->select_by_id($id_cours);
    require_once "views/details_votes.php";
}

function Users($page)
{
    $user = new Utilisateurs(null);
    $categories = new Categories();
    $domaines = new Domaines();
    $users = $user->select();
    require_once 'views/utilisateurs.php';
}

function User($page){
    $categories = new Categories();
    $statuses = $categories->select();
    $domaine = new Domaines();
    $domaines = $domaine->select();

    require_once 'views/addUser.php';
}

function Upload($page)
{
    require_once "views/upload.php";
}

function Votes($page)
{
    $vote = new Votes;
    $votes = $vote->select();
    require_once "views/votes.php";
}

function Mailbox($page)
{
    $utilisateur = new Utilisateurs(null);
    $utilisateurs = $utilisateur->selectReceived();
    require_once "views/mailbox.php";
}

function Profile($page, $id)
{
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
    $settings = new Settings();
    $notes = $settings->select();
    extract($notes);
    require_once "views/settings.php";
}

function Programmes($page)
{
    require_once "controllers/compiler.php";
    include "exports.php";
    $id_filiere = $_GET["id"];
    $fil = new Domaines();
    $nom_fil = $fil->select_by_id($id_filiere)[0]["nom"];
    $compiler = new Compiler($id_filiere);
    $compiler->compile();
    $programme = $compiler->getFullFinalProgram();
    exportToExcel($programme, $nom_fil);
    require_once 'views/programmes.php';
}

function UploadUser($page)
{
    require_once "views/upuser.php";
}

function UploadCotes($page)
{
    require_once "views/upcotes.php";
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
