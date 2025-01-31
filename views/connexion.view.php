<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="login">
        <div class="description">
            <h1>Nom de l'application</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna.</p>
        </div>
        <div class="container">
            <div class="card" id="card">
                <div class="card__face card__face--front">
                    <h2>Connexion</h2>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="signin-password" placeholder="Mot de passe">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('signin-password', this)"></i>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" onclick="redirectToPostIt()">Connexion</button>
                    </div>
                    <button class="toggle-button" onclick="toggleCard()">Pas encore de compte? Inscription</button>
                </div>
                <div class="card__face card__face--back">
                    <h2>Inscription</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Pseudo">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" placeholder="Date de naissance">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="signup-password" placeholder="Mot de passe">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-password', this)"></i>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="signup-confirm-password" placeholder="Confirmation de mot de passe">
                        <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-confirm-password', this)"></i>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" onclick="redirectToPostIt()">Inscription</button>
                    </div>
                    <button class="toggle-button" onclick="toggleCard()">Déja un comtpte? Connexion</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleCard() {
            $('#card').toggleClass('is-flipped');
        }

        function redirectToPostIt() {
            window.location.href = '?action=list';
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