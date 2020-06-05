<?php
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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
    $spreadsheet = new Spreadsheet();
    $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadSheet = $Reader->load("cours.xlsx");
    require_once 'views/utilisateurs.php';
}

function Votes($page)
{
    require_once 'views/votes.php';
}


function Programmes($page)
{
    require_once 'views/programmes.php';
    
}

function Accueil($page)
{
    require_once 'views/accueil.php';
}
