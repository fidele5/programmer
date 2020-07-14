<?php
    session_start();
    require_once '../models/cotes.php';
    
        if (isset($_GET["action"]))
        {
            $action = $_GET["action"];
        }
        extract($_POST);
        $i = 0;
        switch ($action) {
        
            case "ajouter":
                $cotes = new Cotes($_FILES);
                $cotes->upload();
                $cotes->Save();
                echo "ok";
                
            break;

            case 'update':
               $cotes =  new Cotes(null);
               $cotes->update();
               echo "okay";
            break;
            case "delete":
                $id = $_GET["id"];
                $delete = $cotes->delete($id);
                header("location: ../utilisateurs");
                break;
            default:
                break;
        }
        