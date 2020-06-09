<?php
    require_once "../models/cours.php";
    $cours = new Cours;

    $cour = $cours->exists($_GET['cours']);

    if ($cour > 0) {
        echo "ko";
    }else echo "ok";