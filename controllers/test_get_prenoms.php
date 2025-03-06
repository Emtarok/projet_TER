<?php
// fichier qui a servi uniquement pour tester des fonctions pour le debug
require_once '..\models\postit.model.php';

$terme = 'so'; // Terme de recherche pour tester la fonction
$prenoms = get_prenoms($terme);

echo "<pre>";
print_r($prenoms);
echo "</pre>";
?>