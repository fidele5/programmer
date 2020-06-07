<?php
    session_start();
    require_once '../models/utilisateurs.php';
    $utilisateurs = new Utilisateurs();
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
                    header("location: ../utilisateurs/ajouter");
                }else{
                    $ajouter = $utilisateurs->insert($nom_complet, $login, $password, $email, $categorie_id, $domaine_id);
                    header("location: ../utilisateurs");
                }
            break;

            case "delete":
                $id = $_GET["id"];
                $delete = $utilisateurs->delete($id);
                header("location: ../utilisateurs");
                break;
            default:
                break;
        }
        