
<?php
    session_start();
    require_once '../models/categories.php';
    $categories = new Categories();
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
                    header("location: ../categories/ajouter");
                }else{
                    $ajouter = $categories->insert($nom);
                    header("location: ../categories");
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
                    header("location: ../categories/modifier");
                }else{
                    $ajouter = $categories->update($id,$nom);
                    header("location: ../categories");
                }
                break;
            case "delete":
                $id = $_GET["id"];
                $delete = $categories->delete($id);
                header("location: ../categories");
                break;
            default:
                break;
        }
        