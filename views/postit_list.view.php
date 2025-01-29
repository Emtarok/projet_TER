<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../public/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="postit.html">NomApp</a>
        <div class="navbar-right">
            <form action="#">
                <div class="search-container">
                    <input type="search" name="search" id="search-item" placeholder="Rechercher">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <a href="#">Accueil</a>
            <a href="#">Profil</a>
            <a href="#">Contact</a>
            <a href="#">Deconnexion</a>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="middle-column">
            <div class="postit-card">
                <div class="card-body">
                    <div>
                        <h5 class="card-title"><a href="?action=details"> Post 2</a></h5>
                        <p>Publié par John Doe</p>
                        <small class="text-muted">Publié le: 2023-10-02</small>
                    </div>
                </div>
            </div>
            <div class="postit-card">
                <div class="card-body">
                    <div>
                        <h5 class="card-title"><a href="?action=details"> Post 2</a></h5>
                        <p>Publié par John Doe</p>  
                        <small class="text-muted">Publié le: 2023-10-02</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-column">
            <div class="postit-card">
                <div class="card-body">
                    <a href="#" class="card-title">Post partagé pour vous</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
