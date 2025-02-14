Répértoire pour le projet de TER

Date limite : 6 mars 12h00

Outils de gestion de projet : Trello, Bizagi, Excel Outils de développement : Git, php, html/css, Javascript, BootStrap, Jquery

Base de donnée :

Dans une architecture en étoile, les tables de dimension servent à enrichir la table des faits avec des informations détaillées. Ici, la question est de savoir si les post-its partagés doivent être dans une table distincte ou s'ils restent dans la table PostIt. Un post-it partagé est un post-it existant, simplement visible par un autre utilisateur. Il n'y a pas de transformation du post-it lors du partage. La table PostIt contient déjà les informations descriptives du post-it (titre, contenu, auteur). Il n'est pas nécessaire de créer une table de dimension spécifique pour les post-its partagés. L'information du partage est déjà bien gérée par la table des faits Fait_PostIt, qui établit la relation entre un post-it, son auteur et l'utilisateur avec qui il est partagé.

UNIQUE (id_postit, id_utilisateur_partage) permet d'éviter les doublons dans la table des faits_postit

Le Partage d'un post-it (possibilité):

jquery, utilisation de l'auto-complétion
html, liste des tous les utilisateurs et on séléctionne le bon
javascript, utilisation de filtre similaire au projet de boutique web
Pour choisir l'utilisateur avec lequel on partage le post-it on a choisi jquery car c'est celui le plus utilisé dans le monde l'entreprise et c'est le plus pratique pour l'utilisateur. On utilisera le nom et le prenom pour faire la recherche.