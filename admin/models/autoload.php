
<?php
    function my_autoloader()
    {
    
        include "votes.php";
        include "utilisateurs.php";
        include "promotions.php";
        include "domaines.php";
        include "cours.php";
        include "categories.php";
        include "admins.php";
    }

    spl_autoload_register("my_autoloader");

    