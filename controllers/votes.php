<<<<<<< HEAD
<?php
session_start();
require_once '../models/votes.php';
$votes = new Votes();
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
            header("location: ../votes/ajouter");
        } else {
            $ajouter = $votes->insert($utilisateurs_id, $cours_id, $promotions_id);
            header("location: ../votes");
        }
        break;
    case "delete":
        $id = $_GET["id"];
        $delete = $votes->delete($id);
        header("location: ../votes");
        break;
    default:
        echo "okay";
        extract($_POST);
        if (!isset($_SESSION['voted'])) {
           $_SESSION['voted'] = array();
        }

        if (is_array($data)) {
            if (exists($promotion)) {
                reset_data($promotion, $data);
            }
            else {
                $action = array($promotion => $data);
                array_push($_SESSION["voted"], $action);
            }

        }
        
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        
        break;

}

function exists($promotion)
{
    if (isset($_SESSION['voted'])) {
        foreach ($_SESSION['voted'] as $value) {
            if (key($value) == $promotion) {
                return true;
            }
        }
    } else {
        return false;
    }

}

function reset_data($promotion, $data)
{
    if (isset($_SESSION['voted'])) {
        foreach ($_SESSION['voted'] as $val) {
            if (key($val) == $promotion) {
                unset($val);
                $action = array($promotion => $data);
                array_push($_SESSION["voted"], $action);
                return true;
            }
        }
    } else {
        return false;
    }

}

=======
<?php
session_start();
require_once '../models/votes.php';
$votes = new Votes();
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}
extract($_POST);
$i = 0;
switch ($action) {

    case "ajouter":
        foreach ($_SESSION['voted'] as $value) {
            if (empty($value)) {
                $i++;
            } else {
                continue;
            }
        }
        if ($i > 0) {
            $_SESSION["message"] = "Vous devez remplir tous les champs";
            header("location: ../votes/ajouter");
        } else {
            foreach ($_SESSION['voted'] as $k => $value) {
                foreach ($value as $cle => $valeur) {
                    foreach ($valeur as $key => $val) {
                        $ajouter = $votes->insert(1, $val['id'], $k);
                    }
                    //$ajouter = $votes->insert(1, $val['id'], $k);
                    echo "ok";
                }
            }
        }
        break;
    case "delete":
        $id = $_GET["id"];
        $delete = $votes->delete($id);
        header("location: ../votes");
        break;
    default:
        echo "okay";
        extract($_POST);
        if (!isset($_SESSION['voted'])) {
            $_SESSION['voted'] = array();
        }

        if (is_array($data)) {
            if (exists($promotion)) {
                $_SESSION['voted'] = reset_data($promotion, $data);
            } else {
                $action = array($promotion => $data);
                array_push($_SESSION["voted"], $action);
            }

        }

        break;

}

function exists($promotion)
{
    if (isset($_SESSION['voted'])) {
        foreach ($_SESSION['voted'] as $value) {
            if (key($value) == $promotion) {
                return true;
            }
        }
    } else {
        return false;
    }

}

function reset_data($promotion, $data)
{
    if (isset($_SESSION['voted'])) {
        $temp = array();
        foreach ($_SESSION['voted'] as $key => $value) {
            //echo key($value);
            if (key($value) == $promotion) {
                $action = array($promotion => $data);
                array_push($temp, $action);
            } else {
                array_push($temp, $value);
            }
        }
        return $temp;

    } else {
        return null;
    }

}
>>>>>>> 86335429dec8973fd7edf18732314d0f7ff6de3c
