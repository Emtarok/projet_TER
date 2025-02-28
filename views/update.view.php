<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <a class="nav-link" href="/postit.html">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.html">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.html">Deconnexion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="middle-column">
            <div class="postit-form card">
                <div class="card-body">
                    <h2>Modifier un post</h2>
                    <form action="?action=update" method="POST">
                        <div class="form-group">
                            <label for="title">Titre:<?php get_title() ?></label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $postit->getTitle() ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu: <?php get_content() ?></label>
                            <textarea class="form-control" id="content" rows="3" name="content" required><?= $postit->getContent() ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>