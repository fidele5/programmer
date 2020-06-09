<?php
    session_start();
    require_once '../models/utilisateurs.php';
    
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        extract($_POST);
        $i = 0;
        switch ($action) {
        
            case "ajouter":
                $utilisateurs = new Utilisateurs($_FILES);
                $utilisateurs->upload();
                $utilisateurs->Save();
                echo "ok";
                
            break;

            case "delete":
                $id = $_GET["id"];
                $delete = $utilisateurs->delete($id);
                header("location: ../utilisateurs");
                break;
            default:
                break;
        }
        