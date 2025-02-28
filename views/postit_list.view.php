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
            <div class="create_postit">
                <div class="title">
                    <button class="btn btn-primary" onclick="window.location.href='?action=create'"><i class="fas fa-plus"></i></button>
                    <h5 class="card-title-h5">La liste de vos Post-it</h5>
                    <div></div>
                </div>
                
                <!-- structure d'un postit. -->
                <?php
                if (!empty($data)) {
                    foreach ($data as $datas){
                    echo "
                    <div class=\"postit-card card\">
                        <div class=\"card-body\">
                            <div>
                                <h5 class=\"card-title\"><a href=\"?action=details&id=".$data['idpost']."\">".$data['titre']."</a></h5>
                                <p>".$data['contenu']."</p>
                                <small class=\"test-muted\">Publié le : ".$data['date']."</small>
                            </div>
                        </div>
                    </div>";
                    }
                }else {
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
                <div class="postit-card card">
                    <div class="card-body">
                        <a href="#" class="card-title">Post partagé pour vous</a>
                    </div>
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
    </script>
</body>
</html>