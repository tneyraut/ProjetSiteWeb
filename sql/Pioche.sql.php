<?php

Pioche::addQuery('INITIALISER_PIOCHE', 'INSERT INTO pioche(partie_id,wagon_id,nombre) VALUES (:partie_id,:wagon_id,:nb)');

Pioche::addQuery('REMETTRE_CARTES_DEFAUSSEES', 
        'UPDATE pioche
         SET nombre=nombre+:nb
         WHERE partie_id=:partie_id AND wagon_id=:wagon_id');

Pioche::addQuery('GET_ALL_PIOCHE', 
        'SELECT wagon.wagon_id,wagon.type, pioche.nombre 
         FROM pioche 
         INNER JOIN wagon USING(wagon_id)
         WHERE partie_id=:partie_id AND nombre>0');

Pioche::addQuery('CHANGE_NOMBRE_WAGON', 
        'UPDATE pioche 
         SET nombre=:nb
         WHERE partie_id=:partie_id AND wagon_id=:wagon_id');

Pioche::addQuery('SUPPRIMER_PIOCHE_BY_PARTIE', 'DELETE FROM pioche WHERE partie_id=:partie_id');
