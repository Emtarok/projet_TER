document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("inscriptionForm").addEventListener("submit", function (event) {

        var nom = document.getElementById("nom").value;
        var prenom = document.getElementById("prenom").value;
        var email = document.getElementById("email").value;
        var dateNaissance = document.getElementById("dateNaissance").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        // Vérification des champs du formulaire
        if(nom === "" || prenom === "" || email === "" || dateNaissance === "" || password === "" || confirmPassword === "") {
            document.getElementById("message").innerHTML = "Le formulaire n'est pas complet.";
            event.preventDefault(); // Bloque l'envoi du formulaire
        }
        // Vérification de l'adresse email
        if(!verifEmail(email)){
            document.getElementById("message").innerHTML = "L'adresse email n'est pas valide.";
        }

        // Vérification des mots de passe identiques
        if (password !== confirmPassword) {
            document.getElementById("message").innerHTML = "Les mots de passe ne sont pas identiques.";
            event.preventDefault();
        }

        // Vérification de la date de naissance
        if(!isValidDate(dateNaissance)){
            document.getElementById("message").innerHTML = "La date de naissance n'est pas valide.";
            event.preventDefault();
        }

        //Vérification du format du mot de passe
        var passwordFormat = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;



        
    });
});

function isValidEmail(email) {
    var emailFormat = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
    return(emailFormat.test(email)) 
}

function isValidDate(date) {
    //format date AAAA-MM-JJ
    var dateFormat= /^(19|20)\d{2}\/(0[1-9]|1[0-2])\/(0[1-9]|[12]\d|3[01])$/;
    return(dateFormat.test(date))
}
