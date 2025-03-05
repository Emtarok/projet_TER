$(document).ready(function () {

    let utilisateursSelectionnes = [];

<<<<<<< HEAD
    // Auto-completion
    // On utilise une requête AJAX pour récupérer les suggestions de prénoms en fonction du terme (ce que l'on rentre dans la barre de recherche)
=======
    // Fonction pour mettre à jour l'affichage des tableaux
    function updateDisplay() {
        document.getElementById('utilisateursSelectionnesContent').innerText = JSON.stringify(utilisateursSelectionnes, null, 2);
        const selectedUsers = utilisateursSelectionnes.map(user => user.id);
        document.getElementById('selectedUsersContent').innerText = JSON.stringify(selectedUsers, null, 2);
    }

    // Auto-completion avec requête ajax
>>>>>>> 9df48fb5bec889da02acd31230fc211fbacfd16a
    $("#prenom_partage").on("input", function() {
        let terme = $(this).val();
        console.log("Input event triggered, terme: " + terme);
        if (terme.length >= 2){
<<<<<<< HEAD
        $.ajax({
            url : '/projet_TER/controllers/test.autocomplete.controller.php',
            type : 'GET',
            data : "terme=" + terme,
            dataType : 'json',
            success : function(data){
                console.log("AJAX request successful, raw data: " + data);
                try{
                    if (Array.isArray(data)) { // vérification du type renvoyé par le serveur
                        let suggestionsHTML = "";
                        data.forEach(prenom => {
                            suggestionsHTML += `<li class="list-group-item suggestion">${prenom}</li>`;
                        });
                        $("#suggestions").html(suggestionsHTML).show();
                    } else {
                        console.error("Response is not an array:", data);
                    }
            }catch(error){
                console.error("Error parsing JSON data: " + error);
                console.error("Response data: " + data);
            }
        },
            error: function(xhr, status, error) { // lorsque la requête ajax échoue cela lance la fonction suivante
                console.error("AJAX request failed, status: " + status + ", error: " + error);
                console.error("Response text: " + xhr.responseText);
                console.log(xhr, status, error);
            }
        });
    } else {
        $("#suggestions").hide();
    }
    });

    // Ajout de l'utilisateur sélectionné
    // On affiche les utilisateurs sélectionnés depuis la barre de recherche dans la zone "utilisateurs sélectionnés"
    $(document).on("click", ".suggestion", function() {
        let prenom = $(this).text();
        if (!utilisateursSelectionnes.includes(prenom)) {
            utilisateursSelectionnes.push(prenom);
            $("#utilisateurs_selectionnes").append(`<span class="badge bg-primary m-1 p-2">${prenom} <i class="croix fas fa-times remove-user" data-user="${prenom}"></i></span>`);
            $("#prenom_partage").val("");
=======
            $.ajax({
                url : '/projet_TER/controllers/autocomplete.controller.php',
                type : 'GET',
                data : "terme=" + terme,
                dataType : 'json',
                success : function(data){
                    console.log("AJAX request successful, raw data: " + data);
                    try{
                        if (Array.isArray(data)) {
                            let suggestionsHTML = "";
                            data.forEach(user => {
                                suggestionsHTML += `<li class="list-group-item suggestion" data-id="${user.idutilisateur}">${user.prenom}</li>`;
                            });
                            $("#suggestions").html(suggestionsHTML).show();
                        } else {
                            console.error("Response is not an array:", data);
                        }
                    } catch(error) {
                        console.error("Error parsing JSON data: " + error);
                        console.error("Response data: " + data);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed, status: " + status + ", error: " + error);
                    console.error("Response text: " + xhr.responseText);
                    console.log(xhr, status, error);
                }
            });
        } else {
>>>>>>> 9df48fb5bec889da02acd31230fc211fbacfd16a
            $("#suggestions").hide();
        }
    });

<<<<<<< HEAD
    // Suppression de l'utilisateur selectionne
    // Lors du click sur la croix on supprime l'utilisateur de la liste des utilisateurs sélectionnés
    $(document).on("click", ".remove-user", function() {
        let prenom = $(this).data("user");
        utilisateursSelectionnes = utilisateursSelectionnes.filter(user => user !== prenom);
        $(this).parent().remove();
        $("#utilisateurs_partages").val(JSON.stringify(utilisateursSelectionnes));
=======
    // Ajout de l'utilisateur sélectionné
    $(document).on("click", ".suggestion", function() {
        updateDisplay();
        let prenom = $(this).text();
        let id = $(this).data("id");
        if (!utilisateursSelectionnes.some(user => user.id === id)) {
            utilisateursSelectionnes.push({ id: id, prenom: prenom });
            $("#utilisateurs_selectionnes").append(`<span class="badge bg-primary m-1 p-2">${prenom} <i class="croix fas fa-times remove-user" data-id="${id}"></i></span>`);
            $("#prenom_partage").val("");
            $("#suggestions").hide();
        }
        updateDisplay();
>>>>>>> 9df48fb5bec889da02acd31230fc211fbacfd16a
    });

    // Suppression de l'utilisateur selectionne
    $(document).on("click", ".remove-user", function() {
        let id = $(this).data("id");
        utilisateursSelectionnes = utilisateursSelectionnes.filter(user => user.id !== id);
        $(this).parent().remove();
        updateDisplay();
    });

    // permet de cacher les suggestions lorsqu'on clique en dehors de celle-ci
    $(document).click(function(event){
        if(!$(event.target).closest("#prenom_partage, #suggestions").length){
            $("#suggestions").hide();
        }
    });

    // fonction permettant de récupérer l'id des utilisateurs selectionnés lors de la création d'un post-it (lors de la va)
    function handleSharedUsers() {
        const selectedUsers = utilisateursSelectionnes.map(user => user.id); // Array to store selected user IDs
        document.getElementById('utilisateurs_partages').value = JSON.stringify(selectedUsers);
        updateDisplay();
    }

    // Ajoutez un écouteur d'événement pour la soumission du formulaire
    $("#postitForm").on("submit", function(event) {
        handleSharedUsers();
        console.log("Form submitted with shared users:", document.getElementById('utilisateurs_partages').value); // Ajoutez ce log pour vérifier le champ caché
    });

});