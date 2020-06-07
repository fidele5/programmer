
<?php
    session_start();
    require_once '../models/votes.php';
    $votes = new Votes();
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
                    header("location: ../votes/ajouter");
                }else{
                    $ajouter = $votes->insert($utilisateurs_id, $cours_id, $promotions_id);
                    header("location: ../votes");
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
                    header("location: ../votes/modifier");
                }else{
                    $ajouter = $votes->update($promotions_id,$utilisateurs_id, $cours_id, $promotions_id);
                    header("location: ../votes");
                }
                break;
            case "delete":
                $id = $_GET["id"];
                $delete = $votes->delete($id);
                header("location: ../votes");
                break;
            default:
                break;
        }
        