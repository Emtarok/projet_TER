<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';
require_once __DIR__ . '/../models/inscription.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'connexion';
    $error_message = '';
    switch ($action) {
        case 'connexion':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['email']) && isset($_POST['password'])) {
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    // récupére les données de l'utilisateur
                    $user = get_data($email);
                    
                    // vérifie si $user est un tableau et contient les clés attendues
                    if ($user !== null && is_array($user) && isset($user['email'])) {
                        // vérification du mot de passe
                        if (password_verify($password, $user['motdepasse'])) {
                            //démarragr de la session
                            session_start();
                            $_SESSION['user_id'] = $user['idutilisateur'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['pseudo'] = $user['pseudo'];
                            echo "Connexion réussie";
                            // Envoyer l'utilisateur à la page postit_list
                            header('Location: index.php?action=list');
                            exit();
                        } else {
                            $error_message = "Mot de passe incorrect";
                            //require_once __DIR__ . '/../views/connexion.view.php';
                        }
                    } else {
                        $error_message = "Email incorrect";
                        //require_once __DIR__ . '/../views/connexion.view.php';
                    }
                } else {
                    $error_message = "Veuillez remplir tous les champs";
                    //require_once __DIR__ . '/../views/connexion.view.php';
                }
            } else {
                // echo "Méthode non autorisée";
                //require_once __DIR__ . '/../views/connexion.view.php';
            }
            require_once __DIR__ . '/../views/connexion.view.php';
            break;

        case 'inscription':
            // code pour gérer l'action inscription
            if (!isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['date_naissance'], $_POST['pseudo'], $_POST['password'])) {
                // echo "Veuillez remplir tous les champs";
                require_once __DIR__ . '/../views/inscription.view.php';
                exit();
            } else {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $date_naissance = $_POST['date_naissance'];
                $pseudo = $_POST['pseudo'];
                $password = $_POST['password'];
                //$confirm_password = $_POST['confirm_password'];
                $password_h = password_hash($password, PASSWORD_DEFAULT);
                $response = set_data($nom, $prenom, $email, $date_naissance, $pseudo, $password_h);
                if ($response['success']) {
                    // echo $response['message'];
                    require_once __DIR__ . '/../views/connexion.view.php';
                    exit();
                } else {
                    // echo $response['message'];
                    require_once __DIR__ . '/../views/inscription.view.php';
                    exit();
                }
            }

        case 'deconnexion':
            // ...code pour gérer l'action deconnexion...
            session_start();
            session_unset();
            session_destroy();
            header('Location: index.php?action=connexion');
            exit();

        default:
            echo "Page non trouvée.";
            break;
    }
}
?>