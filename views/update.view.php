<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/postit.model.php';

// Récupérer les utilisateurs partagés pour ce post-it
$sharedUsers = get_shared_users($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="./public/autocomplete.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 mb-4">
        <a class="navbar-brand" href="postit.html">NomApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="#">
                        <div class="search-container">
                            <input type="search" name="search" id="search-item" placeholder="Rechercher">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=list">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=profil">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=deconnexion">Déconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="middle-column">
            <div class="postit-form card">
                <div class="card-body">
                    <h2>Modifier le post</h2>
                    <form action="?action=update_postit" method="POST" id="postitForm">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                        <div class="form-group">
                            <label for="title">Titre:</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($postit['titre']); ?>" required>
                        </div>
                        <div class="form-group"></div>
                            <label for="content">Contenu:</label>
                            <textarea class="form-control" id="content" rows="3" name="content" required><?php echo htmlspecialchars($postit['contenu']); ?></textarea>
                        </div>

                        <!-- Zone de Partage des post-its avec suggestions dynamiques -->
                        <div class="form-group">
                            <label for="prenom_partage">Partager avec :</label>
                            <input type="text" id="prenom_partage" name="prenom_partage" class="form-control" placeholder="Rechercher un utilisateur">
                            <ul id="suggestions" class="list-group"></ul>
                        </div>

                        <!-- liste des utilisateurs ajoutés -->
                        <div class="mt-2">
                            <h5>Utilisateurs sélectionnés :</h5>
                            <div id="utilisateurs_selectionnes">
                            <?php
                                foreach ($sharedUsers as $user) {
                                echo '<span class="badge bg-primary m-1 p-2">';
                                echo htmlspecialchars($user['prenom']);
                                echo ' <i class="croix fas fa-times remove-user" data-id="';
                                echo htmlspecialchars($user['idutilisateur']);
                                echo '"></i></span>';
                                }
                            ?>
                            </div>
                        </div>

                        <input type="hidden" class="mb-4" id="utilisateurs_partages" name="utilisateurs_partages" value='<?php echo json_encode(array_column($sharedUsers, 'idutilisateur')); ?>'>
                        <!-- <p></p> -->
                        <button type="submit" class="btn btn-primary m-4">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>