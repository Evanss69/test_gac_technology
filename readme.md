Mini appli gestion de ticket téléphonique en PHP (version 7.3.12) avec MySQL (version 8.0.18)


-Importer  fichier CSV et ses données dans une BD:


    •Le délimiteur du fichier CSV  pour le test est ";" alors que généralement ","
    •Prend en compte format de données notamment pour la date jj/mm/yyyy alors que BD SQL yyyy-mm-jj
    •Le fichier à importer doit obligatoirement se nommer test_technique_doc.csv  

-Exploiter les données chargées en base de données pour réaliser les requêtes suivantes :

    • Retrouver la durée totale réelle des appels effectués après le 15/02/2012 (inclus)
    • Retrouver le TOP 10 des volumes data facturés en dehors de la tranche horaire 8h00-18h00, par abonné.
    -Cette requete va renvoyer plus qu une valeur,caractère ou chaine de caractères  à prendre en compte lors de l'affichage du résultat on veut pour un abonné les 10 plus gros volumes data facturés hors service.      
    • Retrouver la quantité totale de SMS envoyés par l'ensemble des abonnés

Ces requetes sont effectuées automatiquement lors du lancement de l'application et du rafraichissement de celui-ci.