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
            <div class="create_postit">
                <div class="title">
                    <button class="btn btn-primary" onclick="window.location.href='?action=create'"><i class="fas fa-plus"></i></button>
                    <h5 class="card-title-h5">La liste de vos Post-it</h5>
                    <div></div>
                </div>
                <!-- structure d'un postit. -->
                <?php
                if (!empty($data)) {
                    echo $_SESSION['message'] ?? '';
                    foreach ($data as $postit){
                    echo "
                    <div class=\"postit-card card\">
                        <div class=\"card-body\">
                            <div>
                                <h5 class=\"card-title\"><a href=\"?action=details&id=".$postit['idpostit']."\">".$postit['titre']."</a></h5>
                                <small class=\"text-muted\">Publié le : ".$postit['date_post']."</small>
                            </div>
                            <div class=\"options-container\">
                                <button class=\"btn btn-light btn-sm\" onclick=\"confirmDelete(".$postit['idpostit'].")\"><i class=\"fas fa-trash-alt\"></i></button>
                            </div>
                        </div>
                    </div>";
                    }
                } else {
                    echo "<p>Aucun post-it trouvé</p>";
                }
                ?>
            </div>
        </div>
        <div class="right-column">
            <div class="postit-card card">
                <div class="title">
                    <h5 class="card-title-h5">Postit partagé pour vous</h5>
                    <div></div>
                </div>
                <?php
                if (!empty($datapart)) {
                    echo $_SESSION['message'] ?? '';
                    foreach ($datapart as $postitpart){
                    echo "
                    <div class=\"postit-card card\">
                        <div class=\"card-body\">
                            <div>
                                <h5 class=\"card-title\"><a href=\"?action=partages&id=".$postitpart['idpostit']."\">".$postitpart['titre']." (".$postitpart['prenom']."  ".$postitpart['nom'].")</a></h5>
                                <small class=\"test-muted\">Publié le : ".$postitpart['date_post']."</small>
                            </div>
                        </div>
                    </div>";
                    }
                } else {
                    echo "<p>Aucun post-it trouvé</p>";
                }
                ?>
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
        function redirectToDelete(id) {
            window.location.href = '?action=delete&id=' + id;
        }
        function confirmDelete(id) {
            if (confirm("Êtes-vous sûr de vouloir supprimer ce post-it ?")) {
                window.location.href = '?action=delete&id=' + id;
            }
        }
    </script>
</body>
</html>