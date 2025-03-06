$(document).ready(function () {

    let utilisateursSelectionnes = [];
    let utilisateursSupprimes = [];

    // fonction qui servait uniquement à update un tableau avec le contenu des variables mis en POST pour le debug
    function updateDisplay() {
        document.getElementById('utilisateurs_supprimes_content').innerText = JSON.stringify(utilisateursSupprimes, null, 2);
    }

    // Auto-completion avec requête ajax
    $("#prenom_partage").on("input", function() {
        let terme = $(this).val();
        console.log("Input event triggered, terme: " + terme);
        if (terme.length >= 2){
            $.ajax({
                url : '/projet_TER/controllers/autocomplete.controller.php',
                type : 'GET',
                data : "terme=" + terme,
                dataType : 'json',
                success : function(data){
                    console.log("AJAX request successful, raw data: ", data);
                    try{
                        if (Array.isArray(data)) { // vérification du type renvoyé par le serveur
                            let suggestionsHTML = "";
                            data.forEach(user => {
                                suggestionsHTML += `<li class="list-group-item suggestion" data-id="${user.idutilisateur}">${user.prenom}</li>`;
                            });
                            $("#suggestions").html(suggestionsHTML).show();
                        } else {
                            console.error("Response is not an array:", data);
                        }
                    } catch(error){
                        console.error("Error parsing JSON data: ", error);
                        console.error("Response data: ", data);
                    }
                },
                error: function(xhr, status, error) { // lorsque la requête ajax échoue cela lance la fonction suivante
                    console.error("AJAX request failed, status: ", status, ", error: ", error);
                    console.error("Response text: ", xhr.responseText);
                }
            });
        } else {
            $("#suggestions").hide();
        }
    });

    // Ajout de l'utilisateur sélectionné
    $(document).on("click", ".suggestion", function() {
        let prenom = $(this).text();
        let idutilisateur = $(this).data("id");
        if (!utilisateursSelectionnes.some(user => user.idutilisateur === idutilisateur)) {
            utilisateursSelectionnes.push({ idutilisateur: idutilisateur, prenom: prenom });
            $("#utilisateurs_selectionnes").append(`<span class="badge bg-primary m-1 p-2">${prenom} <i class="croix fas fa-times remove-user" data-id="${idutilisateur}"></i></span>`);
            $("#prenom_partage").val("");
            $("#suggestions").hide();
        }
    });

    // Suppression de l'utilisateur selectionne
    $(document).on("click", ".remove-user", function() {
        let idutilisateur = $(this).data("id");
        utilisateursSelectionnes = utilisateursSelectionnes.filter(user => user.idutilisateur !== idutilisateur);
        utilisateursSupprimes.push(idutilisateur);
        $(this).parent().remove();
    });

    // permet de cacher les suggestions lorsqu'on clique en dehors de celle-ci
    $(document).click(function(event){
        if(!$(event.target).closest("#prenom_partage, #suggestions").length){
            $("#suggestions").hide();
        }
    });

    // fonction permettant de récupérer l'id des utilisateurs selectionnés lors de la création d'un post-it
    function SharedUsers() {
        const selectedUsers = utilisateursSelectionnes.map(user => user.idutilisateur);
        document.getElementById('utilisateurs_partages').value = JSON.stringify(selectedUsers);
    }

    // fonction permettant de récupérer l'id des utilisateurs supprimés lors de la modification d'un post-it
    function RemoveSharedUsers() {
        document.getElementById('utilisateurs_supprimes').value = JSON.stringify(utilisateursSupprimes);
    }

    // Ajoutez un écouteur d'événement pour la soumission du formulaire
    $("#postitForm").on("submit", function(event) {
        SharedUsers();
        RemoveSharedUsers();
    });

});