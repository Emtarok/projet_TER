<?php
require_once __DIR__ . '/../config/database.php';

function get_data($_SESSION['user_id']){
	$userid = $_SESSION['user_id'];
	$conn = db_connect();
    // requête pour récupérer les postit de l'utilisateur
	$sql = "SELECT postit.titre, postit.contenu, postit.date FROM faits, postit WHERE ".$userid." = faits.id_utilisateur AND faits.id_post = postit.idpost ";
	$result = mysqli_query($conn, $sql);
	
    // création d'un tableau pour stocker les données
	$datas = [];
	if ($result && mysqli_num_rows($result)>0 ) {
		while ($row = mysqli_fetch_assoc($result)) {
			$datas[] = $row;
		}
	}
	
	mysqli_close($conn);
	return $datas;
}