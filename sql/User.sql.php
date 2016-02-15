<?php

User::addQuery('IS_LOGIN_USED', 'SELECT login FROM user WHERE login=:login');

User::addQuery('USER_BY_ID', 'SELECT user_id,login,admin,password,nombre_parties_gagnees,nombre_parties_perdues,age,ville_de_naissance,sexe,nationalite FROM user WHERE user_id=:id');

User::addQuery('USER_LIST', 'SELECT login,admin FROM user');

User::addQuery('USER_CREATE', 'INSERT INTO user(login,password,admin,prenom,nom,mail) VALUES (:login,SHA1(:password),:admin,:prenom,:nom,:mail)');

User::addQuery('ADMIN_CREATE', 'INSERT INTO user(login,password,admin) VALUES (:login,SHA1(:password),1)');

User::addQuery('USER_CONNECT', 'SELECT user_id,login,password FROM user WHERE login=:login');

User::addQuery('USER_BY_LOGIN', 'SELECT user_id,login,password,nombre_parties_gagnees,nombre_parties_perdues,age,ville_de_naissance,sexe,nationalite FROM user WHERE login=:login');

User::addQuery('NOMBRE_DE_USERS', 'SELECT COUNT(login) AS nombreDeJoueurs FROM user WHERE admin=0');

User::addQuery('SUPPRIMER_USER', 'DELETE FROM user WHERE login=:login');

User::addQuery('INCREMENTE_PARTIES_GAGNEES', 
        'UPDATE user 
         SET nombre_parties_gagnees=nombre_parties_gagnees+1
         WHERE user_id=:user_id');

User::addQuery('INCREMENTE_PARTIES_PERDUES', 
        'UPDATE user 
         SET nombre_parties_perdues=nombre_parties_perdues+1
         WHERE user_id=:user_id');

User::addQuery('ORDER_BY_NOMBRE_PARTIES_JOUEES_ASC', 
        'SELECT login, nombre_parties_gagnees, nombre_parties_perdues, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees
        FROM user 
        WHERE admin=0 
        ORDER BY nombre_parties_jouees ASC');

User::addQuery('ORDER_BY_NOMBRE_PARTIES_JOUEES_DESC', 
        'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees) AS ratio 
        FROM user 
        WHERE admin=0
        ORDER BY nombre_parties_jouees DESC');

User::addQuery('ORDER_BY_RATIO_ASC', 
        'SELECT login,nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees) AS ratio
            FROM user
            WHERE admin=0
            ORDER BY ratio ASC');

User::addQuery('ORDER_BY_RATIO_DESC', 
        'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees)AS ratio 
        FROM user WHERE admin=0 ORDER BY ratio DESC LIMIT 10');

User::addQuery('ORDER_BY_MEILLEUR_SCORE_ASC', 
        'SELECT user.login, user.nombre_parties_gagnees, user.nombre_parties_perdues,joueur.score 
        FROM user,joueur WHERE user.user_id=joueur.user_id AND user.admin=0 ORDER BY joueur.score ASC LIMIT 10');

User::addQuery('ORDER_BY_MEILLEUR_SCORE_DESC', 
        'SELECT user.login, user.nombre_parties_gagnees, user.nombre_parties_perdues,joueur.score 
        FROM user,joueur WHERE user.user_id=joueur.user_id AND user.admin=0 ORDER BY joueur.score DESC LIMIT 10');

User::addQuery('ORDER_BY_LOGIN_ASC', 
        'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues 
        FROM user WHERE admin=0 ORDER BY login LIMIT 10');

User::addQuery('ORDER_BY_LOGIN_DESC', 
        'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees)AS ratio 
        FROM user WHERE admin=0 ORDER BY login DESC LIMIT 10');

User::addQuery('ORDER_BY_PARTIES_GAGNEES_ASC', 
        'SELECT login, nombre_parties_gagnees, nombre_parties_perdues 
        FROM user WHERE admin=0 ORDER BY nombre_parties_gagnees ASC LIMIT 10');

User::addQuery('ORDER_BY_PARTIES_GAGNEES_DESC', 
        'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees)AS ratio, MAX(score) AS meilleur_score
        FROM joueur 
        INNER JOIN user USING(user_id)
        GROUP BY user_id
        ORDER BY nombre_parties_gagnees DESC');

User::addQuery('ORDER_BY_PARTIES_PERDUES_ASC', 'SELECT login, nombre_parties_gagnees, nombre_parties_perdues 
        FROM user 
        WHERE admin=0 
        ORDER BY nombre_parties_perdues ASC');

User::addQuery('ORDER_BY_PARTIES_PERDUES_DESC', 'SELECT login, nombre_parties_gagnees+nombre_parties_perdues AS nombre_parties_jouees, nombre_parties_gagnees, nombre_parties_perdues,nombre_parties_gagnees/IF(nombre_parties_perdues+nombre_parties_gagnees=0,1,nombre_parties_perdues+nombre_parties_gagnees)AS ratio, MAX(score) AS meilleur_score
        FROM joueur 
        INNER JOIN user USING(user_id)
        GROUP BY user_id
        ORDER BY nombre_parties_perdues DESC');

User::addQuery('MODIFIER_PROFIL', 
        'UPDATE user 
        SET login=:login,nationalite=:nationalite,sexe=:sexe,age=:age,ville_de_naissance=:ville_de_naissance,password=:password 
        WHERE user_id=:id');