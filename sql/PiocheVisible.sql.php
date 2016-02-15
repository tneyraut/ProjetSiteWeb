<?php

PiocheVisible::addQuery('ADD_WAGON_VISIBLE', 'INSERT INTO pioche_visible(wagon_id, partie_id) VALUES (:wagon_id, :partie_id)');

PiocheVisible::addQuery('GET_CARTES',
        'SELECT pioche_visible_id, wagon.type, wagon.image
         FROM pioche_visible
         INNER JOIN wagon USING(wagon_id)
         WHERE pioche_visible.partie_id=:partie_id');

PiocheVisible::addQuery('IS_PRESENT', 'SELECT wagon_id FROM pioche_visible WHERE partie_id=:partie_id AND wagon_id=:wagon_id LIMIT 1');

PiocheVisible::addQuery('REMOVE_BY_TYPE', 'DELETE FROM pioche_visible WHERE partie_id=:partie_id AND wagon_id=:wagon_id LIMIT 1');

PiocheVisible::addQuery('SUPPRIMER_PIOCHE_VISIBLE_BY_PARTIE', 'DELETE FROM pioche_visible WHERE partie_id=:partie_id');
