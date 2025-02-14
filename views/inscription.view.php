<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
    <div class="login">
        <div class="description">
            <h1>Nom de l'application</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna.</p>
        </div>
        <div class="container">
            <div class="card w-100" id="card">
                <div id=message>
                    Tous les champs sont obligatoireq
                </div>
                <div class="card__face card__face--back">
                    <h2>Inscription</h2>
                    <form action="connexion.controller.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="pseudo" placeholder="Pseudo">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="date" class="form-control" name="date_naissance" placeholder="Date de naissance">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="signup-password" name="password" placeholder="Mot de passe">
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-password', this)"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="signup-confirm-password" name="confirm_password" placeholder="Confirmation de mot de passe">
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-confirm-password', this)"></i>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                        </div>
                    </form>
                    <button class="toggle-button" onclick="redirectToSignUp()">Déja un compte? Connexion</button>
                </div>
            </div>
        </div>
    </div>
    <script src="../public/js/verification.js"></script>
    <script>
        function redirectToSignUp() {
            window.location.href = '?action=inscription';
        }
        function togglePassword(fieldId, icon) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>