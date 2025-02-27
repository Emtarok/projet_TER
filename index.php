<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/gif" href="public/img/list.jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <title>Post-It</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    
</body>
</html>
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