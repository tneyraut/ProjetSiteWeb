<?php

Route::addQuery('ROUTES_BY_MAP',
        'SELECT route.route_id, route.longueur, route.couleur, ville1.nom AS ville1, ville2.nom AS ville2, route.type, route.points, route.stroke_dasharray
         FROM route
         INNER JOIN ville AS ville1 ON route.ville1_id=ville1.ville_id
         INNER JOIN ville AS ville2 ON route.ville2_id=ville2.ville_id
         WHERE route.map_id=:map_id
         ORDER BY ville1,ville2');

Route::addQuery('ROUTE_BY_ID',
        'SELECT route.route_id, route.longueur, route.couleur, ville1.nom AS ville1, ville2.nom AS ville2, route.type, route.points, route.stroke_dasharray
         FROM route
         INNER JOIN ville AS ville1 ON route.ville1_id=ville1.ville_id
         INNER JOIN ville AS ville2 ON route.ville2_id=ville2.ville_id
         WHERE route.route_id=:route_id
         ORDER BY route_id');

Route::addQuery('ROUTE_PROPRIETAIRE',
        'SELECT user.login, joueur.couleur
         FROM joueur_route
         INNER JOIN route ON joueur_route.route_id=route.route_id
         INNER JOIN joueur ON joueur_route.joueur_id=joueur.joueur_id
         INNER JOIN user ON joueur.user_id = user.user_id
         WHERE joueur_route.route_id=:route_id AND joueur.partie_id=:partie_id
         ORDER BY user.login');

Route::addQuery('CONSTRUIRE_ROUTE', 'INSERT INTO joueur_route(joueur_id,route_id,nb_locomotive) VALUES (:joueur_id,:route_id,:nb_locomotive)');

Route::addQuery('SUPPRIMER_JOUEUR_ROUTE_BY_PARTIE', 'DELETE FROM joueur_route WHERE partie_id=:partie_id');

Route::addQuery('GET_BY_JOUEUR',
        'SELECT route.route_id, route.longueur, ville1.nom AS ville1, ville2.nom AS ville2
         FROM joueur_route
         INNER JOIN route USING(route_id)
         INNER JOIN ville AS ville1 ON route.ville1_id=ville1.ville_id
         INNER JOIN ville AS ville2 ON route.ville2_id=ville2.ville_id
         WHERE joueur_route.joueur_id=:joueur_id
         ORDER BY route_id');