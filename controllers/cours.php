<?php
    session_start();
    require_once '../models/cours.php';
    $cours = new Cours();
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        extract($_POST);
        $i = 0;
        switch ($action) {
            case "ajouter":
                foreach ($data as $key => $value) {
                    extract($value);
                    //$ajouter = $cours->insert($intitule, $volume, 1);
                }
                echo "ok";
            break;
            case "delete":
                $id = $_GET["id"];
                $delete = $cours->delete($id);
                header("location: ../cours");
                break;
            default:
                break;
        }
        