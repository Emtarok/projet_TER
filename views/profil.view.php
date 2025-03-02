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
    <title>Profil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100 mb-4">
        <a class="navbar-brand" href="?action=list">NomApp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
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
    <div class="container">
        <div class="car" id="card">
            <div class="card__pro card__pro--file">
                <h2>Profil de l'utilisateur</h2>
                <form>
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="date_naissance">Date de naissance:</label>
                        <input type="text" class="form-control" id="date_naissance" value="<?php echo htmlspecialchars($user['date_naissance']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pseudo">Pseudo:</label>
                        <input type="text" class="form-control" id="pseudo" value="<?php echo htmlspecialchars($user['pseudo']); ?>" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>