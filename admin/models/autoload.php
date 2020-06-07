<<<<<<< HEAD
<?php
function my_autoloader2()
{
    include "votes.php";
    include "utilisateurs.php";
    include "promotions.php";
    include "domaines.php";
    //include "cours.php";
    include "categories.php";
    //include "Categorie_cours.php";
    include "admins.php";
    include "cotes.php";
}

spl_autoload_register("my_autoloader2");
=======
<?php
function my_autoloader2()
{
    include "votes.php";
    include "utilisateurs.php";
    include "promotions.php";
    include "domaines.php";
    include "cours.php";
    include "categories.php";
    include "Categorie_cours.php";
    include "admins.php";
    include "cotes.php";
}

spl_autoload_register("my_autoloader2");
>>>>>>> 52931c821211c5f70acd0471fca6a06b34b28f96
