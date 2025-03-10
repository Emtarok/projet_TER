<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'connexion':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['email']) && isset($_POST['password'])){
            
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    //recuperer a travers get_data() les données de la base de données
                    $user = get_data($email);
                    if ($user !== null) {
                        //vérification du mot de passe
                        if ($password == $user['motdepasse']) {
                            session_start();
                            $_SESSION['user_id'] = $user['idutilisateur'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['pseudo'] = $user['pseudo'];
                            echo "Connexion réussie";
                            //envoyer l'utilisateur à la page postit_list
                            require_once __DIR__ . '/../views/postit_list.view.php';
                            exit();
                        }else{
                            echo "Mot de passe incorrect";
                        }
                    }else{
                        echo "Email incorrect";
                        // require_once __DIR__ . '/../views/connexion.view.php';
                    }
                }else{
                    echo "Veuillez remplir tous les champs";
                }
            }else{
                echo "Méthode non autorisée";
                require_once __DIR__ . '/../views/connexion.view.php';
            }
            break; 

        default:
            echo "Page non trouvée.";
    }
}
?>