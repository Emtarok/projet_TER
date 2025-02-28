<?php
    if (!isset($_SESSION)) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="./public/autocomplete.js"></script>
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
                    <a class="nav-link" href="#">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Deconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="middle-column">
            <div class="postit-form card">
                <div class="card-body">
                    <h2>Créer un post</h2>
                    <form action="?action=create_postit" method="POST">
                        <div class="form-group">
                            <label for="title">Titre:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu:</label>
                            <textarea class="form-control" id="content" rows="3" name="content" required></textarea>
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
                            <div id="utilisateurs_selectionnes"></div>
                         </div>
                         <input type="hidden" id="utilisateurs_partages" name="utilisateurs_partages">

                         <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>