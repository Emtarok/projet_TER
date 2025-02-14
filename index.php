<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'connexion':
        require_once __DIR__ . '/controllers/connexion.controller.php';
        break;

    case 'inscription':
        require_once __DIR__ . '/controllers/inscription.controller.php';
        break;

    case 'details':
        require_once __DIR__ . '/controllers/postit_detail.controller.php';
        break;
    
    case 'list':
        require_once __DIR__ . '/controllers/postit_list.controller.php';
        break;
    
    case 'create':
        require_once __DIR__ . '/controllers/creation.controller.php';
        break;
    
    case 'create_postit':
        require_once __DIR__ . '/controllers/creation.controller.php';
        break;

    default:
        require_once __DIR__ . '/controllers/controller.php';
        break;
}

// Traiter la requête
if (function_exists('handle_request')) {
    handle_request();
} else {
    echo "Erreur: La fonction handle_request n'est pas définie.";
}
?>