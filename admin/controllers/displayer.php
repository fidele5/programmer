<?php
session_start();
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
    require_once 'views/votes.php';
}

function Utilisateurs($page)
{
    require_once 'views/utilisateurs.php';
    
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
