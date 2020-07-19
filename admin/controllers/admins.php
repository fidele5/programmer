
<?php
    session_start();
    require_once '../models/admins.php';
    $admins = new Admins();
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        extract($_POST);
        $i = 0;
        switch ($action) {
        
            case "login":
                $connexion = $admins->Login($psw);
                foreach ($_POST as $value) {
                    if (empty($value)) {
                        $i++;
                    }
                    else {
                        continue;
                    }
                }

                if ($i > 0) {
                    $_SESSION["erreur_login"] = "Vous devez remplir tous les champs";
                    header("location: ../index.php");
                }
                else{
                    if (count($connexion) > 0) {
                        if ($connexion[0]["login"] == $login) {
                            $_SESSION["admin_login"] = $login;
                            $_SESSION["admin_id"] = $connexion[0]["id"];
                            header("location: ../index.php");
                        }
                        else {
                            $_SESSION["erreur_login"] = "Login ou mot de passe incorrect";
                            header("location: ../index.php");
                        }
                    }
                    else {
                        $_SESSION["erreur_login"] = "Login ou mot de passe incorrect";
                        header("location: ../index.php");
                    }
                }
            break;
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
                    header("location: ../admins/ajouter");
                }else{
                    $ajouter = $admins->insert($login, $mdp);
                    header("location: ../admins");
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
                    header("location: ../admins/modifier");
                }else{
                    $ajouter = $admins->update($id,$login, $mdp);
                    header("location: ../admins");
                }
                break;
            case "delete":
                $id = $_GET["id"];
                $delete = $admins->delete($id);
                header("location: ../admins");
                break;
            default:
                break;
        }
        