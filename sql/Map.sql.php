<?php

Map::addQuery('GET_MAP_ID_BY_NAME', 'SELECT map_id FROM map WHERE nom=:nom');

Map::addQuery('GET_MAP', 
        'SELECT map.map_id, map.nom, map.image, map.image_pioche, map.image_carte_destination, map.image_fond_carte_destination
         FROM partie 
         INNER JOIN map USING(map_id)
         WHERE partie_id=:partie_id');