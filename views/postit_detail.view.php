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
            <div class="postit-card card">
            <!-- // affichage du postit sélectionné -->
                <?php
                    foreach ($postitdetail as $postit){
                        echo "
                        <div class=\"card-body\">
                            <div>
                                <h5 class=\"card-title\">".$postit['titre']."</h5>
                                <p class=\"card-text\">".$postit['contenu']."</p>
                                <small class=\"text-muted\">Publié le: ".$postit['date_post']."</small>
                            </div>
                            <div class=\"options-container\">
                                <button class=\"btn btn-light btn-sm\" onclick=\"redirectTo(".$postit['idpostit'].")\"><i class=\"fas fa-ellipsis-h\"></i></button>
                                <div class=\"options-menu\">
                                    <button onclick=\"redirectTo(".$postit['idpostit'].")\">Modifier</button>
                                    <button onclick=\"redirectToDelete(".$postit['idpostit'].")\">Supprimer</button>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
                <div class="card-footer">
                    <div class="reaction-container">
                        <button class="btn btn-light btn-sm"><i class="fas fa-thumbs-up"></i> J'aime</button>
                        <div class="reaction-buttons">
                            <button class="btn btn-light btn-sm" style="color: #007BFF;"><i class="fas fa-thumbs-up"></i></button>
                            <button class="btn btn-light btn-sm" style="color: #FFD700;"><i class="fas fa-laugh"></i></button>
                            <button class="btn btn-light btn-sm" style="color: #FF4500;"><i class="fas fa-angry"></i></button>
                            <button class="btn btn-light btn-sm" style="color: #1E90FF;"><i class="fas fa-sad-tear"></i></button>
                            <button class="btn btn-light btn-sm" style="color: #FF1493;"><i class="fas fa-heart"></i></button>
                        </div>
                    </div>
                    <button class="btn btn-light btn-sm" onclick="toggleCommentSection(this)"><i class="fas fa-comment"></i> Commenter</button>
                    <button class="btn btn-light btn-sm"><i class="fas fa-share"></i> Partager</button>
                </div>
                <div class="comment-section">
                    <textarea class="form-control" rows="2" placeholder="Ecrire un commentaire..."></textarea>
                    <button class="btn btn-primary btn-sm mt-2">Commenter</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleCommentSection(button) {
            const commentSection = button.closest('.postit-card').querySelector('.comment-section');
            commentSection.style.display = commentSection.style.display === 'none' || commentSection.style.display === '' ? 'block' : 'none';
            commentSection.style.paddingRight = '10px';
            commentSection.style.marginLeft = '10px';
            commentSection.style.marginBottom = '10px';
        }
        function redirectTo(id) {
            window.location.href = '?action=update&id=' + id;
        }
        function redirectToDelete(id) {
            window.location.href = '?action=delete&id=' + id;
        }
    </script>
</body>
</html>