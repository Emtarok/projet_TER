<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/inscription.model.php';

function handle_request() {
    // ...code pour gérer l'action inscription...
    if(!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['date_naissance'], $_POST['pseudo'], $_POST['password'])){
        echo "Veuillez remplir tous les champs";
        require_once __DIR__ . '/../views/inscription.view.php';
        exit();
    }else{
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $date_naissance = $_POST['date_naissance'];
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        if($password != $confirm_password){
            echo "Les mots de passe ne correspondent pas";
            require_once __DIR__ . '/../views/inscription.view.php';
            exit();
        }
    }
}

?>