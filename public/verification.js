document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("inscriptionForm").addEventListener("submit", function (event) {

        var valid=true;

        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var pseudo = document.getElementById("pseudo").value;
        var email = document.getElementById("email").value;
        var dateNaissance = document.getElementById("date_naissance").value;
        var password = document.getElementById("signup-password").value;
        var confirmPassword = document.getElementById("signup-confirm-password").value;

        // Réinitialisation des messages d'erreur
        resetMessage(document.getElementById("email"), "msg-email");
        resetMessage(document.getElementById("date_naissance"), "msg-date");
        resetMessage(document.getElementById("signup-password"), "msg-password1");
        resetMessage( document.getElementById("signup-confirm-password"), "msg-password2");

        // Vérification des champs du formulaire
        if(nom === "" || prenom === "" || email === "" || pseudo==="" || dateNaissance === "" || password === "" || confirmPassword === "") {
            document.getElementById("msg-form").innerHTML = "Tous les champs sont obligatoires.";
            valid=false;
        }
        // Vérification de l'adresse email
        if(!isValidEmail(email)){
            afficherMessage(document.getElementById("email"), "msg-email", "L'adresse email n'est pas valide.");
            valid=false;
        }

        // Vérification de la date de naissance
        if(!isValidDate(dateNaissance)){
            afficherMessage(document.getElementById("date_naissance"), "msg-date", "La date de naissance n'est pas valide. YYYY-MM-DD");
            valid=false;
        }elseif(!moment(dateNaissance, "YYYY-MM-DD").isBefore(moment())){
            afficherMessage(document.getElementById("date_naissance"), "msg-date", "La date de naissance doit être antérieure à la date d'aujourd'hui.");
            valid=false;
        }

        //Vérification du format du mot de passe
        if(password.length<6){
            document.getElementById("msg-password").innerHTML = "Le mot de passe doit contenir au moins 6 caractères.";
            valid=false;
        }

        // Vérification des mots de passe identiques
        if (password !== confirmPassword) {
            afficherMessage(document.getElementById("signup-confirm-password"), "msg-password2", "Les mots de passe ne correspondent pas.");
            valid=false;
        }

        if(!valid){
            event.preventDefault();
        }
    });
});
function afficherMessage(element, idmsg, message) {
    element.classList.add("input-error");
    document.getElementById(idmsg).innerHTML = message;
}

function resetMessage(element, idmsg) {
    element.classList.remove("input-error");
    document.getElementById(idmsg).innerHTML = "";
}

function isValidEmail(email) {
    var emailFormat = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return(emailFormat.test(email)) 
}

function isValidDate(date) {
    //format date AAAA/MM/JJ
    return moment(date, 'YYYY-MM-DD', true).isValid();
}
