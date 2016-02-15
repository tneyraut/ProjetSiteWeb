<?php

Main::addQuery('ADD_WAGON', 'INSERT INTO main(joueur_id,wagon_id) VALUES (:joueur_id,:wagon_id)');

Main::addQuery('GET_CARTES_MAIN',
        'SELECT wagon.wagon_id, wagon.type, wagon.image
         FROM main
         INNER JOIN joueur USING(joueur_id)
         INNER JOIN wagon USING(wagon_id)
         WHERE main.joueur_id=:joueur_id
         ORDER BY wagon.type');

Main::addQuery('REMOVE_WAGONS', 
        'DELETE FROM main
         WHERE main.wagon_id IN
            (SELECT wagon_id
             FROM wagon
             WHERE type=:type)
         AND main.joueur_id=:joueur_id
         LIMIT :nb');

Main::addQuery('SUPPRIMER_MAIN_BY_JOUEUR', 'DELETE FROM main WHERE joueur_id=:joueur_id');
