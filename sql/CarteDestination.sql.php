<?php
CarteDestination::addQuery('ADD_CARTE_DESTINATION', 
        'INSERT INTO joueur_carte_destination(joueur_id,carte_destination_id,possedee)
         VALUES (:joueur_id,:carte_destination_id,:possedee)');

CarteDestination::addQuery('CLEAR_CARTES_NON_POSSEDEES', 
        'DELETE FROM joueur_carte_destination
         WHERE joueur_id=:joueur_id AND possedee=0');

CarteDestination::addQuery('GET_CARTES_DESTINATION',
        'SELECT carte_destination_id, nombre_points, ville1.nom AS ville1, ville2.nom AS ville2
         FROM joueur_carte_destination
         INNER JOIN carte_destination USING(carte_destination_id)
         INNER JOIN ville AS ville1 ON carte_destination.ville1_id = ville1.ville_id
         INNER JOIN ville AS ville2 ON carte_destination.ville2_id = ville2.ville_id
         WHERE joueur_carte_destination.joueur_id=:joueur_id AND possedee=1
         ORDER BY nombre_points');

CarteDestination::addQuery('GET_CARTES_PIOCHEES',
        'SELECT carte_destination_id, nombre_points, ville1.nom AS ville1, ville2.nom AS ville2
         FROM joueur_carte_destination
         INNER JOIN carte_destination USING(carte_destination_id)
         INNER JOIN ville AS ville1 ON carte_destination.ville1_id = ville1.ville_id
         INNER JOIN ville AS ville2 ON carte_destination.ville2_id = ville2.ville_id
         WHERE joueur_carte_destination.joueur_id=:joueur_id AND possedee=0
         ORDER BY nombre_points');

CarteDestination::addQuery('GET_PIOCHE_CARTE_DESTINATION', 
        'SELECT carte_destination_id, nombre_points, ville1.nom AS ville1, ville2.nom AS ville2
         FROM carte_destination
         INNER JOIN ville AS ville1 ON carte_destination.ville1_id = ville1.ville_id
         INNER JOIN ville AS ville2 ON carte_destination.ville2_id = ville2.ville_id
         WHERE carte_destination.carte_destination_id NOT IN
            (SELECT joueur_carte_destination.carte_destination_id
             FROM joueur_carte_destination
             INNER JOIN joueur USING(joueur_id)
             WHERE joueur.partie_id=:partie_id)
         AND carte_destination.map_id=:map_id
         ORDER BY nombre_points');

CarteDestination::addQuery('SUPPRIMER_JOUEUR_CARTER_DESTINATION_BY_JOUEUR', 'DELETE FROM joueur_carte_destination WHERE joueur_id:joueur_id');

CarteDestination::addQuery('CARTES_DESTINATION_LES_PLUS_UTILISEES_BY_MAP', 
        'SELECT COUNT(carte_destination_id) AS nombreUtilisations, carte_destination_id, nombre_points, ville1.nom AS ville1, ville2.nom AS ville2, map.nom 
        FROM joueur_carte_destination
        INNER JOIN carte_destination USING (carte_destination_id)
        INNER JOIN ville AS ville1 ON carte_destination.ville1_id = ville1.ville_id 
        INNER JOIN ville AS ville2 ON carte_destination.ville2_id = ville2.ville_id 
        INNER JOIN map ON map.map_id = carte_destination.map_id 
        WHERE possedee=1 AND map.map_id=:map_id
        GROUP BY carte_destination_id, nombre_points,ville1, ville2, nom
        ORDER BY nombreUtilisations DESC');


CarteDestination::addQuery('CARTES_DESTINATION_LES_PLUS_REUSSIES_BY_MAP', 
        'SELECT COUNT(carte_destination_id) AS nombreUtilisations, carte_destination_id, nombre_points, ville1.nom AS ville1, ville2.nom AS ville2, map.nom 
        FROM joueur_carte_destination
        INNER JOIN carte_destination USING (carte_destination_id)
        INNER JOIN ville AS ville1 ON carte_destination.ville1_id = ville1.ville_id 
        INNER JOIN ville AS ville2 ON carte_destination.ville2_id = ville2.ville_id 
        INNER JOIN map ON map.map_id = carte_destination.map_id 
        WHERE success=1 AND map.map_id=:map_id
        GROUP BY carte_destination_id, nombre_points,ville1, ville2, nom
        ORDER BY nombreUtilisations DESC
        LIMIT 10');