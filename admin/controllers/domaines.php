
<?php
    session_start();
    require_once '../models/domaines.php';
    $domaines = new Domaines();
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        extract($_POST);
        $i = 0;
        switch ($action) {
        
            case "ajouter":
                foreach ($_POST as $value) {
                    if (empty($value)) {
                        $i++;
                    }
                    else {
                        continue;
                    }
                }

                if ($i > 0) {
                    $_SESSION["message"] = "Vous devez remplir tous les champs";
                    header("location: ../domaines/ajouter");
                }else{
                    $ajouter = $domaines->insert($nom);
                    header("location: ../domaines");
                }
            break;
            case "modifier":
                foreach ($_POST as $value) {
                    if (empty($value)) {
                        $i++;
                    }
                    else {
                        continue;
                    }
                }

                if ($i > 0) {
                    $_SESSION["message"] = "Vous devez remplir tous les champs";
                    header("location: ../domaines/modifier");
                }else{
                    $ajouter = $domaines->update($id,$nom);
                    header("location: ../domaines");
                }
                break;
            case "delete":
                $id = $_GET["id"];
                $delete = $domaines->delete($id);
                header("location: ../domaines");
                break;
            default:
                break;
        }
        