<?php
require_once 'controllers/displayer.php';
$page = (isset($_GET["page"])) ? $_GET["page"] : 'accueil';
$pages = ["accueil", "prepa", "G1", "G2", "G3", "L1", "L2", "L3", "g1", "g2", "g3", "l1", "l2", "l3", 'login', 'signin', "logout"];

try {
    if (empty($page)) {
        throw new Exception('page non disponible', 1);
    } elseif (!in_array($page, $pages)) {
        throw new Exception('page non disponible', 1);
    } else {
        switch ($page) {
            case 'login':
                Login($page);
                break;
            case 'logout':
                Logout();
                break;
            case 'signin':
                Signup($page);
                break;
            default:
                if (!is_connected()) {
                    header("location: login");
                } else {
                    Accueil($page);
                }
                break;
        }
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
