$(document).ready(function () {

    let utilisateursSelectionnes = [];

    // Auto-completion
    // On utilise une requête AJAX pour récupérer les suggestions de prénoms en fonction du terme (ce que l'on rentre dans la barre de recherche)
    $("#prenom_partage").on("input", function() {
        let terme = $(this).val();
        console.log("Input event triggered, terme: " + terme);
        if (terme.length >= 2){
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
            $("#suggestions").hide();
        }
    });

    // Suppression de l'utilisateur selectionne
    // Lors du click sur la croix on supprime l'utilisateur de la liste des utilisateurs sélectionnés
    $(document).on("click", ".remove-user", function() {
        let prenom = $(this).data("user");
        utilisateursSelectionnes = utilisateursSelectionnes.filter(user => user !== prenom);
        $(this).parent().remove();
        $("#utilisateurs_partages").val(JSON.stringify(utilisateursSelectionnes));
    });

    $(document).click(function(event){
        if(!$(event.target).closest("#prenom_partage, #suggestions").length){
            $("#suggestions").hide();
        }
    });

});