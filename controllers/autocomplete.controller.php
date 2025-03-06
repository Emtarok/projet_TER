<?php 
// page retourne les prenoms des utilisateurs selectionne pour le partage depuis la creation ou modification de post-it
// C'est cette page sur laquelle la requête AJAX est envoyée
require_once __DIR__ . '/../models/postit.model.php';

$prenoms = get_prenoms($_GET['terme']);
header('Content-Type: application/json');
echo json_encode($prenoms);

?>