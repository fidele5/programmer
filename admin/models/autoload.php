<?php
function my_autoloader2()
{
    include_once "votes.php";
    include_once "utilisateurs.php";
    include_once "promotions.php";
    include_once "domaines.php";
    include_once "cours.php";
    include_once "categories.php";
    include_once "Categorie_cours.php";
    include_once "admins.php";
    include_once "settings.php";
    include_once "cotes.php";
}

spl_autoload_register("my_autoloader2");
