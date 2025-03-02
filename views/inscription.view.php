<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="login">
        <div class="description">
            <h1>Nom de l'application</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl eros, pulvinar facilisis justo mollis, auctor consequat urna.</p>
        </div>
        <div class="container">
            <div class="card w-100" id="card">
            <div class="error-message" id="msg-form"></div>
                <div class="card__face card__face--back">
                    <h2>Inscription</h2>
                    <form id="inscriptionForm" action="?action=inscription" method="POST" onsubmit="return validateForm()">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
                            <div class="error-message" id="msg-nom"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                            <div class="error-message" id="msg-pr"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                            <div class="error-message" id="msg-email"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"id="date_naissance" name="date_naissance" placeholder="YYYY-MM-DD">
                            <div class="error-message" id="msg-date"></div>
                        </div>
                        <div class="form-group" id="msg-password1">
                            <input type="password" class="form-control" id="signup-password" name="password" placeholder="Mot de passe">
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-password', this)"></i>
                            <div class="error-message" id="msg-password1"></div>
                        </div>
                        <div class="form-group" id="msg-password2">
                            <input type="password" class="form-control" id="signup-confirm-password" name="confirm_password" placeholder="Confirmation de mot de passe">
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('signup-confirm-password', this)"></i>
                            <div class="error-message" id="msg-password2"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                        </div>
                    </form>
                    <button class="toggle-button" onclick="redirectToSignIn()">Déja un compte? Connexion</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="../public/js/verification.js"></script>s -->
    <script>
        // $(document).ready(function{
        //     $("#inscriptionForm").validate({
        //         rules: {
        //             nom: {
        //                 required: true,
        //             },
        //             prenom: {
        //                 required: true,
        //             },
        //             pseudo: {
        //                 required: true,
        //             },
        //             email: {
        //                 required: true,
        //                 email: true
        //             },
        //             date_naissance: {
        //                 required: true,
        //                 date: true
        //             },
        //             password: {
        //                 required: true,
        //                 minlength: 6
        //             },
        //             confirm_password: {
        //                 required: true,
        //                 equalTo: "#signup-password"
        //             },
        //         },
        //             messages: {
        //                 nom: "Veuillez entrer votre nom",
        //                 prenom: "Veuillez entrer votre prénom",
        //                 pseudo: {
        //                     required: "Veuillez entrer votre pseudo",
        //                     minlength: "Le pseudo doit contenir au moins 2 caractères"
        //                 },
        //                 email: {
        //                     required: "Veuillez entrer votre email",
        //                     email: "Veuillez entrer une adresse email valide"
        //                 },
        //                 date_naissance: {
        //                     required: "Veuillez entrer votre date de naissance",
        //                     date: "Veuillez entrer une date valide"
        //                 },
        //                 password: {
        //                     required: "Veuillez entrer votre mot de passe",
        //                     minlength: "Le mot de passe doit contenir au moins 6 caractères"
        //                 },
        //                 confirm_password: {
        //                     required: "Veuillez confirmer votre mot de passe",
        //                     equalTo: "Les mots de passe ne correspondent pas"
        //                 },
        //         },
        //         //soumettre le formulaire seulement si il est valide
        //         submitHandler: function(form) {
        //             form.submit();
        //         },
        //         $("#inscriptionForm").submit(function(event) {
        //             if (!$(this).valid()) {
        //                 event.preventDefault(); 
        //             }
                
        //         });
        //     });
        // });
        function redirectToSignIn() {
            window.location.href = '?action=connexion';
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
        function validateForm(){
            let isValid = true;
            // Modifier le DOM en effacant le message precedent
            document.getElementById('msg-nom').innerText = '';
            document.getElementById('msg-pr').innerText = '';
            document.getElementById('msg-email').innerText = '';
            document.getElementById('msg-date').innerText = '';
            document.getElementById('msg-password1').innerText = '';
            document.getElementById('msg-password2').innerText = '';
            // Verifier le nom
            const nom = document.getElementById('nom').value;
            if (nom.trim() === '') {
                document.getElementById('msg-nom').innerText = 'Le nom est requis.';
                isValid = false;
            }
            // Verifier le prenom
            const prenom = document.getElementById('prenom').value;
            if (prenom.trim() === '') {
                document.getElementById('msg-pr').innerText = 'Le prénom est requis.';
                isValid = false;
            }
            // Verifier que l'email renseigne est bien un email
            const email = document.getElementById('email').value;
            if (email.trim() === '') {
                document.getElementById('msg-email').innerText = 'L\'email est requis.';
                isValid = false;
            } else if (!email.includes('@')) {
                document.getElementById('msg-email').innerText = 'L\'email doit contenir un @.';
                isValid = false;
            }
            // Verifier la date de naissance
            const date_naissance = document.getElementById('date_naissance').value;
            if (date_naissance.trim() === '') {
                document.getElementById('msg-date').innerText = 'La date de naissance est requise.';
                isValid = false;
            } else if (!moment(date_naissance, 'YYYY-MM-DD', true).isValid()) {
                document.getElementById('msg-date').innerText = 'La date de naissance doit être au format YYYY-MM-DD.';
                isValid = false;
            }
            // Verifier le mot de passe
            const password = document.getElementById('signup-password').value;
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/;
            if (password.trim() === '') {
                document.getElementById('msg-password1').innerText = 'Le mot de passe est requis.';
                isValid = false;
            } else if (!passwordRegex.test(password)) {
                document.getElementById('msg-password1').innerText = 'Le mot de passe doit contenir au moins 6 caractères, un chiffre, un symbole et des lettres.';
                isValid = false;
            }
            // Verifier la confirmation de mot de passe
            const confirm_password = document.getElementById('signup-confirm-password').value;
            if (confirm_password.trim() === '') {
                document.getElementById('msg-password2').innerText = 'La confirmation de mot de passe est requise.';
                isValid = false;
            } else if (confirm_password !== password) {
                document.getElementById('msg-password2').innerText = 'Les mots de passe ne correspondent pas.';
                isValid = false;
            }
            return isValid;
        }
    </script>
</body>
</html>