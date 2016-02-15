<?php

Joueur::addQuery('PARTICIPANTS', 
        'SELECT joueur.joueur_id, user.login, user.user_id, joueur.couleur, joueur.score, joueur.jetons
         FROM joueur 
         INNER JOIN user USING(user_id)
         WHERE partie_id=:id
         ORDER BY user.login');

Joueur::addQuery('ADD_PARTICIPANT', 'INSERT INTO joueur(user_id,partie_id,couleur) VALUES (:user_id,:partie_id,:couleur)');

Joueur::addQuery('REMOVE_PARTICIPANT', 'DELETE FROM joueur WHERE partie_id=:partie_id AND user_id=:user_id');

Joueur::addQuery('GET_BY_ID', 
        'SELECT joueur_id, score, jetons, couleur, user.login 
         FROM joueur 
         INNER JOIN user USING(user_id) 
         WHERE joueur_id=:joueur_id');

Joueur::addQuery('GET_BY_USER', 
        'SELECT joueur_id, score, user.login , jetons, couleur
         FROM joueur 
         INNER JOIN user USING(user_id) 
         WHERE partie_id=:partie_id AND user_id=:user_id 
         ORDER BY user.login');

Joueur::addQuery('REMOVE_JETONS', 
        'UPDATE joueur 
         SET jetons=jetons-:nb
         WHERE joueur_id=:joueur_id');

Joueur::addQuery('INCREMENTE_SCORE', 
        'UPDATE joueur 
         SET score=score+:nb
         WHERE joueur_id=:joueur_id');

Joueur::addQuery('SET_SCORE', 
        'UPDATE joueur 
         SET score=:score
         WHERE joueur_id=:joueur_id');

Joueur::addQuery('SUPPRIMER_JOUEUR_BY_PARTIE', 'DELETE FROM joueur WHERE partie_id=:partie_id');
