<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <div class="contrainer-fluid">
        <div class="top">
            <div class="create_postit">
                <h5 class="card-title">La liste de vos Post-it</h5>
                <button class="btn btn-primary" onclick="window.location.href='?action=create'">Nouveau</button>
            </div>
            <div class="create_postit">
                <h5 class="card-title">Post partagé pour vous</h5>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="middle-column">
            
        // création de la boucle pour afficher les post-it depuis la base de données
        <?php
            foreach ($data in $datas){
            echo "
            <div class=\"postit-card card\">
                <div class=\"card-body\">
                    <div>
                        <h5 class=\"card-title\"><a href=\"?action=details\">".$data['titre']."</a></h5>
                        <p>".$data['contenu']."</p>
                        <small class=\"test-muted\">Publié le : ".$data['date']."</small>
                    </div>
                </div>
            </div>";
            }
        ?>

        </div>
        <div class="right-column">
            <div class="postit-card card">
                <div class="card-body">
                    <a href="#" class="card-title">Post partagé pour vous</a>
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