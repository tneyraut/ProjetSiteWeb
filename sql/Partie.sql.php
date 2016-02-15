<?php

Partie::addQuery('NOMBRE_PARTIES_JOUEES', 'SELECT COUNT(partie_id) AS nombre_parties_jouees FROM partie');

Partie::addQuery('NOMBRE_PARTIES_TERMINEES', 'SELECT COUNT(partie_id) AS nombre_parties_terminees FROM partie WHERE etat=4');

Partie::addQuery('NOMBRE_PARTIES_EN_COURS', 'SELECT COUNT(partie_id) AS nombre_parties_en_cours FROM partie WHERE etat!=0 AND etat!=4');

Partie::addQuery('PARTIE_DESCRIPTION', 
        'SELECT partie.partie_id, partie.nom,createur_id, user.login AS createur, nombre_max_joueurs, tour_joueur_id, nombre_cartes_piochees, publique, etat, map.map_id, map.nom AS map 
         FROM partie 
         INNER JOIN map USING(map_id)
         INNER JOIN user ON partie.createur_id = user.user_id
         WHERE partie.partie_id=:partie_id');

Partie::addQuery('GET_NOMBRE_CARTES_PIOCHEES', 
        'SELECT nombre_cartes_piochees
         FROM partie
         WHERE partie_id=:partie_id');

Partie::addQuery('PARTIE_BY_ID', 
        'SELECT nom,  tour_joueur_id, etat, nombre_cartes_piochees, dernier_tour_joueur_id
         FROM partie
         WHERE partie_id=:partie_id');

Partie::addQuery('PARTIE_AU_SUIVANT', 
        'UPDATE partie
         SET tour_joueur_id=:tour_joueur_id, nombre_cartes_piochees=0
         WHERE partie_id=:partie_id');

Partie::addQuery('INCREMENTER_PIOCHE', 
        'UPDATE partie
         SET nombre_cartes_piochees=nombre_cartes_piochees+:nb
         WHERE partie_id=:partie_id');

Partie::addQuery('CHANGER_ETAT', 'UPDATE partie SET etat=:etat WHERE partie_id=:partie_id');

Partie::addQuery('SET_TOUR', 'UPDATE partie SET tour_joueur_id=:tourPremierJoueur WHERE partie_id=:partie_id');

Partie::addQuery('PARTIE_DERNIER_TOUR', 'UPDATE partie SET etat=3, dernier_tour_joueur_id=:joueur_id WHERE partie_id=:partie_id');

Partie::addQuery('IS_LANCEE', 'SELECT etat FROM partie WHERE partie_id=:partie_id');

Partie::addQuery('PARTIE_EN_COURS_CREATION_BY_USER_ID', 
        'SELECT partie.partie_id, partie.nom, partie.nombre_max_joueurs, partie.publique, createur.login AS createur
        FROM partie
        INNER JOIN joueur USING(partie_id)
        INNER JOIN user ON user.user_id=joueur.user_id
        INNER JOIN user AS createur ON partie.createur_id = createur.user_id
        WHERE joueur.user_id=:id AND partie.etat=0');

Partie::addQuery('PARTIE_EN_COURS_BY_USER_ID', 
        'SELECT partie.partie_id, partie.nom, partie.nombre_max_joueurs, partie.publique, user.login AS createur
         FROM joueur
         INNER JOIN partie USING(partie_id)
         INNER JOIN user ON partie.createur_id = user.user_id
         WHERE joueur.user_id=:id AND partie.etat!=0 AND partie.etat!=4');

Partie::addQuery('LISTE_PARTIE_PUBLIQUE', 
        'SELECT partie_id, partie.nom, partie.nombre_max_joueurs, user.login AS createur
         FROM partie 
         INNER JOIN user ON partie.createur_id = user.user_id
         WHERE publique=1 AND etat=0');

Partie::addQuery('PARTIE_TERMINEES_BY_USER_ID', 
        'SELECT partie_id, partie.nom, partie.nombre_max_joueurs, user.login AS createur
         FROM partie
         INNER JOIN joueur USING(partie_id)
         INNER JOIN user ON partie.createur_id = user.user_id
         WHERE joueur.user_id=:id AND etat=4');

Partie::addQuery('PARTIE_INVITATION_BY_USER_ID',
        'SELECT invitation.invitation_id, partie.partie_id, partie.nom AS nomPartie, user.login, partie.nombre_max_joueurs, partie.publique, partie.etat, map.nom, invitation.accepter
        FROM user,partie,invitation,map
        WHERE user.user_id=invitation.inviteur_id AND partie.partie_id=invitation.partie_id AND map.map_id=partie.map_id AND invitation.invite_id=:id');

Partie::addQuery('CREER_PARTIE',
        'INSERT INTO partie(nom,nombre_max_joueurs,map_id,publique,createur_id,etat)
        VALUES (:nom,:nombreJoueurs,:map_id,:publique,:createur_id,0)');

Partie::addQuery('PARTIE_ID', 'SELECT partie_id FROM partie ORDER BY partie_id');

Partie::addQuery('AJOUTER_INVITATION',
        'INSERT INTO invitation(partie_id,inviteur_id,invite_id)
        VALUES (:partie_id,:inviteur_id,:invite_id)');

Partie::addQuery('ACCEPTER_INVITATION', 'UPDATE invitation SET accepter=1 WHERE invitation_id=:id');

Partie::addQuery('REFUSER_INVITATION', 'DELETE FROM invitation WHERE invitation_id=:idInvitation');

Partie::addQuery('SUPPRIMER_INVITATIONS_BY_USER_SUPPRESSION', 'DELETE FROM invitation WHERE inviteur_id=:id OR invite_id=:id');

Partie::addQuery('PARTIE_BY_USER', 'SELECT partie.partie_id FROM partie,joueur WHERE partie.partie_id=joueur.partie_id AND (joueur.joueur_id=:id OR partie.createur_id=:id)');

Partie::addQuery('SUPPRIMER_PARTIE_BY_ID', 'DELETE FROM partie WHERE partie_id=:id');

Partie::addQuery('SUPPRIMER_INVITATION_BY_PARTIE', 'DELETE FROM invitation WHERE partie_id=:partie_id');

Partie::addQuery('NOMBRE_JOUEURS_MOYEN_PAR_PARTIE', 
        'SELECT AVG(nb_joueurs) AS nombre_de_joueurs_moyen
        FROM (
            SELECT partie_id, COUNT(joueur_id) AS nb_joueurs
            FROM joueur
            INNER JOIN partie USING(partie_id)
            GROUP BY partie_id
                )
        AS t');

Partie::addQuery('NOMBRE_PARTIES_BY_MAP_ID','SELECT COUNT(partie_id) AS nombreParties FROM partie WHERE map_id=:map_id');

Partie::addQuery('NOMBRE_PARTIES_EN_COURS_BY_MAP_ID', 'SELECT COUNT(partie_id) AS nombrePartiesEnCours FROM partie WHERE map_id=:map_id AND etat!=0 AND etat!=4');

Partie::addQuery('NOMBRE_PARTIES_TERMINEES_BY_MAP_ID', 'SELECT COUNT(partie_id) AS nombrePartiesTerminees FROM partie WHERE map_id=:map_id AND etat=4');

Partie::addQuery('NOMBRE_MOYEN_JOUEURS_BY_PARTIE_AND_MAP_ID', 
        'SELECT AVG(nb_joueurs) AS nombreJoueurs
        FROM (
            SELECT partie_id, COUNT(joueur_id) AS nb_joueurs
            FROM joueur
            INNER JOIN partie USING(partie_id)
            WHERE map_id=:map_id
            GROUP BY partie_id
                )
        AS t');

Partie::addQuery('NOMBRE_MOYEN_JOKERS_BY_PARTIE', 
        'SELECT AVG(nb_jokers) AS resultat
        FROM (
            SELECT partie_id, SUM(nb_locomotive) AS nb_jokers
            FROM joueur_route
            INNER JOIN joueur USING(joueur_id)
            INNER JOIN partie USING(partie_id)
            GROUP BY partie_id
                )
        AS t');

Partie::addQuery('NOMBRE_MOYEN_JOKERS_BY_PARTIE_AND_MAP_ID', 
        'SELECT AVG(nb_jokers) AS resultat
        FROM (
            SELECT partie_id, SUM(nb_locomotive) AS nb_jokers
            FROM joueur_route
            INNER JOIN joueur USING(joueur_id)
            INNER JOIN partie USING(partie_id)
            WHERE partie.map_id=:map_id
            GROUP BY partie_id
                )
        AS t');

Partie::addQuery('NOMBRE_MOYEN_CARTES_DESTINATION_REUSSIES_BY_PARTIE', 
        'SELECT AVG(nb_cartes_destination) AS resultat
        FROM (
            SELECT partie_id, COUNT(joueur_carte_destination.joueur_carte_destination_id) AS nb_cartes_destination
            FROM joueur_carte_destination
            INNER JOIN joueur USING(joueur_id)
            INNER JOIN partie USING(partie_id)
            WHERE success=1
            GROUP BY partie_id
                )
        AS t');
    
Partie::addQuery('NOMBRE_MOYEN_CARTES_DESTINATION_REUSSIES_BY_PARTIE_AND_MAP_ID', 
        'SELECT AVG(nb_cartes_destination) AS resultat
        FROM (
            SELECT partie_id, COUNT(joueur_carte_destination.joueur_carte_destination_id) AS nb_cartes_destination
            FROM joueur_carte_destination
            INNER JOIN joueur USING(joueur_id)
            INNER JOIN partie USING(partie_id)
            WHERE success=1 AND partie.map_id=:map_id
            GROUP BY partie_id
                )
        AS t');
