<?php

Ville::addQuery('VILLES_PLUS_UTILISEES_BY_MAP', 
        'SELECT ville1.nom AS ville1, ville2.nom AS ville2
         FROM joueur_route
         INNER JOIN route USING(route_id)
         INNER JOIN ville AS ville1 ON route.ville1_id=ville1.ville_id
         INNER JOIN ville AS ville2 ON route.ville2_id=ville2.ville_id
         WHERE ville1.map_id=:map_id 
         ORDER BY ville1.nom, ville2.nom');