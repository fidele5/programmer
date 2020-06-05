
<?php
session_start();
require_once '../models/promotions.php';
$promotions = new Promotions();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {

    case "ajouter":
        foreach ($_POST as $value) {
            if (empty($value)) {
                $i++;
            } else {
                continue;
            }
        }

        if ($i > 0) {
            $_SESSION["message"] = "Vous devez remplir tous les champs";
            header("location: ../promotions/ajouter");
        } else {
            $ajouter = $promotions->insert($designation, $domaines_id);
            header("location: ../promotions");
        }
        break;

    case "delete":
        $id = $_GET["id"];
        $delete = $promotions->delete($id);
        header("location: ../promotions");
        break;
    default:
        break;
}
