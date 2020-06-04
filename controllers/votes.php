<?php
session_start();
require_once 'process.php';
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
           
        } else {
            $process = new Process($_SESSION['voted'], array(), $_SESSION['id']);
            $process->process();
            echo "ok";
        }
        break;
    default:
        echo "okay";
        extract($_POST);
        if (!isset($_SESSION['voted'])) {
            $_SESSION['voted'] = array(
                "prepa" => array(),
                "G1" => array(),
                "G2" => array(),
                "G3" => array(),
            );

        }
        if (is_array($data)) {
            if (in_array($promotion, array_keys($_SESSION['voted']))) {
                $_SESSION['voted'] = reset_data($promotion, $data);
            }
        }
        break;
}

function reset_data($promotion, $data)
{
    if (isset($_SESSION['voted'])) {
        $temp = array(
            "prepa" => array(),
            "G1" => array(),
            "G2" => array(),
            "G3" => array(),
        );

        foreach ($_SESSION['voted'] as $key => $value) {
            if ($key == $promotion) {
                for ($i=0; $i < count($data) ; $i++) { 
                    array_push($temp[$promotion], $data[$i]);   
                }
            } else {
                if (is_array($value)) {
                    if(count($value) > 0){
                        for ($j = 0; $j < count($value); $j++) {
                            array_push($temp[$key], $value[$j]);
                        }
                    }
                }
                else{
                    array_push($temp[$key], $value);
                }
            }
        }
        return $temp;

    } else {
        return null;
    }

}
