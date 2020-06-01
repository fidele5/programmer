<?php
session_start();
require_once 'models/autoload.php';
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

function Votes($page)
{
    $cours = new Cours();
    $datas = $cours->select();
    $promotions = new Promotions();
    $datas1 = $promotions->select();
    $utilisateurs = new Utilisateurs();
    $datas2 = $utilisateurs->select();
    if (isset($_GET["action"])) {
        if ($_GET["action"] == 'ajouter') {
            $action = $_GET["action"];
            require_once 'views/actions/votes.php';
        } elseif ($_GET["action"] == 'modifier') {
            $votes = new Votes();
            $action = $_GET["action"];
            $id = $_GET["id"];
            $data = $votes->select_by_id($id);
            require_once 'views/actions/votes.php';
        }
    } else {
        $votes = new Votes();
        $data = $votes->select();
        require_once 'views/votes.php';
    }
}

function Utilisateurs($page)
{
    $categories = new Categories();
    $datas2 = $categories->select();
    $domaines = new Domaines();
    $datas = $domaines->select();
    if (isset($_GET["action"])) {
        if ($_GET["action"] == 'ajouter') {
            $action = $_GET["action"];
            require_once 'views/actions/utilisateurs.php';
        } elseif ($_GET["action"] == 'modifier') {
            $utilisateurs = new Utilisateurs();
            $action = $_GET["action"];
            $id = $_GET["id"];
            $data = $utilisateurs->select_by_id($id);
            require_once 'views/actions/utilisateurs.php';
        }
    } else {
        $utilisateurs = new Utilisateurs();
        $data = $utilisateurs->select();
        require_once 'views/utilisateurs.php';
    }
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
