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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
    <section class="w-100 px-4 py-5" style="border-radius: .5rem .5rem 0 0;">
        <div class="row d-flex justify-content-center container-fluid">
            <div class="col col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-4">   
                        <div class="d-flex">
                            <div class="flex-shrink-0 position-relative">
                                <img src="https://refugedulacdulou.com/wp-content/uploads/2019/01/avatar-anonyme.png"
                                    alt="Generic placeholder image" class="img-fluid rounded-circle" style="width: 180px;">
                                <a href="#" class="position-absolute top-0 start-100 translate-middle p-2 bg-light border rounded-circle" style="transform: translate(-50%, -50%);">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5 class="mb-1 ml-3"><?php echo htmlspecialchars($user['prenom']) . ' ' . htmlspecialchars($user['nom']); ?></h5>
                                <p class="mb-2 pb-1 ml-3 center"><?php echo htmlspecialchars($user['pseudo']); ?></p>
                                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                                    <div>
                                        <p class="small text-muted mb-1">Email</p>
                                        <p class="mb-0"><?php echo htmlspecialchars($user['email']); ?></p>
                                    </div>
                                    <div class="px-3">
                                        <p class="small text-muted mb-1">Date de naissance</p>
                                        <p class="mb-0"><?php echo htmlspecialchars($user['date_naissance']); ?></p>
                                    </div>
                                </div>
                                <div class="d-flex pt-1">
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-secondary me-1 flex-grow-1">Chat</button>
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-secondary flex-grow-1">Follow</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
