
<?php
    require_once 'controllers/displayer.php';
    if (!is_connected()) {
        $page  = 'login';
    } else {
        $page = (isset($_GET["page"]))?$_GET["page"]:'accueil';
    }
    try{
        if(empty($page)) throw new Exception('page non disponible', 1);
        else{
            switch($page)
            {
                case 'login':
                    Login($page);
                break;
                case 'votes':
                    Votes($page);
                break;
                case 'utilisateurs':
                    Utilisateurs($page);
                break;
                case 'logout' :
                    Logout();
                break;
                default:
                    Accueil($page);
                break;
            }
        }
    }
    catch(Exception $e){
        die('Erreur : '.$e);
    }