<?php 
require_once __DIR__ . '/../models/postit.model.php';

$prenoms = get_prenoms($_GET['terme']);
header('Content-Type: application/json');
echo json_encode($prenoms);

?>