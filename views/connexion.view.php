<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="login">
        <div class="description">
            <h1>Nom de l'application</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna.</p>
        </div>
        <div class="container">
            <div class="card w-100" id="card">
                <div class="card__face card__face--front">
                    <h2>Connexion</h2>
                    <form action="?action=connexion" method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="signin-password" name="password" placeholder="Mot de passe">
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('signin-password', this)"></i>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                        </div>
                    </form>
                    <button class="toggle-button" onclick="redirectToSignUp()">Pas encore de compte? Inscription</button>
                </div>
            </div>
        </div>
    </div>
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