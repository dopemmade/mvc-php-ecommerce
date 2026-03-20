<?php
    require_once 'config.php';
    require_once 'models/model.php';
    if (!isset($_SESSION['carrello'])) {
        $_SESSION['carrello'] = [];
    }
    $connessione=getDbconnection();

    $pagina=$_GET['pagina'] ?? 'home';

    switch($pagina){
        case 'home':
            require_once 'controllers/homeController.php';
            break;
        case 'catalogo':
            require_once 'controllers/catalogoController.php';
            break;   
        case 'chisiamo':
            require_once 'controllers/chisiamoController.php';
            break;
        case 'contatti':
            require_once 'controllers/contattiController.php';
            break;
        case 'carrello':
            require_once 'controllers/carrelloController.php';
            break;
        case 'login':
            require_once 'controllers/loginController.php';
            break;
        case 'registrazione':
            require_once 'controllers/registrazioneController.php';
            break;
        case 'elabora':
            require_once 'controllers/elaboraController.php';
            break; 
        case 'autentica':
            require_once 'controllers/autenticaController.php';
            break; 
        case 'profilo':
            require_once 'controllers/profiloController.php';
            break; 
        case 'aggiorna_foto':
        // Qui carichiamo la logica PHP che salva il file
        include 'controllers/aggiorna_foto.php'; 
        break;
    }
?>