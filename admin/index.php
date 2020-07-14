<?php
require_once 'controllers/displayer.php';
if (!is_connected()) {
    $page = 'login';
} else {
    $page = (isset($_GET["page"])) ? $_GET["page"] : 'accueil';
}
try {
    if (empty($page)) {
        throw new Exception('page non disponible', 1);
    } else {
        switch ($page) {
            case 'login':
                Login($page);
                break;
            case 'programmes':
                Programmes($page);
                break;
            case 'users':
                Users($page);
                break;
            case 'uprogram':
                Upload($page);
                break;
            case 'courses':
                Courses($page);
            break;
            case "mailbox":
                Mailbox($page);
                break;
            case "details":
                if (isset($_GET['id'])) {
                    Details($page, $_GET['id']);
                }
                else throw new Exception("Error Processing Request", 1);
            break;
            case "setting":
                if (isset($_GET['id'])) {
                    Profile($page, $_GET['id']);
                } else {
                    throw new Exception("Error Processing Request", 1);
                }

                break;
            case "votes":
                Votes($page);
            break;
            case 'settings':
                Settings($page);
                break;
            case 'upuser':
                UploadUser($page);
                break;
            case 'upcotes':
                UploadCotes($page);
                break;
            case 'logout':
                Logout();
                break;
            default:
                Accueil($page);
                break;
        }
    }
} catch (Exception $e) {
    die('Erreur : ' . $e);
}
