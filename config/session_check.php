<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ?action=connexion');
    exit();
}else{
    require_once __DIR__ . '/../views/postit_list.view.php';
}
?>
