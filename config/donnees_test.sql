SET FOREIGN_KEY_CHECKS=0; 

TRUNCATE joueur_route;
TRUNCATE invitation;
TRUNCATE joueur;
TRUNCATE partie;
TRUNCATE joueur_carte_destination;
TRUNCATE main;
TRUNCATE user;
TRUNCATE pioche;
TRUNCATE pioche_visible;
TRUNCATE message;
TRUNCATE ami;
TRUNCATE conversation;

INSERT INTO user(user_id,login,password,admin) VALUES (1,'admin', SHA1('motDePasseIntrouvable'), 1);

INSERT INTO user(user_id,login,password,nombre_parties_gagnees,nombre_parties_perdues,prenom,nom,mail) VALUES 
(2,'vador', SHA1('vador'), 202, 124, 'Dark', 'Vador', 'dark.vador@starwars.fr'),
(3,'obiwan', SHA1('obiwan'), 69, 2, 'Obiwan', 'Kenobi', 'obi@gmail.com');

INSERT INTO user(user_id,login,password,nombre_parties_gagnees,nombre_parties_perdues,age,prenom,nom,mail) VALUES 
(4,'yoda', SHA1('yoda'), 234, 1, 400, 'Yoda', 'Maître', 'yoda@starwars.fr'),
(5,'luke', SHA1('luke'), 57, 12, 20, 'Luke', 'Skywalker', 'luke.skywalker@starwars.fr'),
(6,'sacha', SHA1('sacha'), 37, 98, 15, 'Sacha', 'Sacha', 'sacha.sacha@pokemon.fr'),
(7,'anakin', SHA1('anakin'), 1, 1, 20,'Anakin', 'Skywalker', 'anakin.skywalker@starwars.fr');

INSERT INTO user(user_id,login,password,nombre_parties_gagnees,nombre_parties_perdues,age,prenom,nom,mail,sexe,ville_de_naissance,nationalite) VALUES 
(8,'phoenix', SHA1('penserTrouverPassword'), 103, 45, 21, 'Thomas', 'Neyraut', 'prenom.nom@jesaisplus.untruc', 'Homme', 'Nice', 'Française');



INSERT INTO ami(user_id,user_ami_id,accepter) VALUES 
(4,6,1),
(4,7,1),
(4,3,1),
(8,4,1),
(8,6,1);

INSERT INTO ami(user_id,user_ami_id) VALUES 
(8,5),
(4,2),
(5,4),
(5,8),
(5,2);

INSERT INTO conversation(locuteur1_id,locuteur2_id) VALUES
(4,3),
(4,7),
(8,4);

INSERT INTO message(destinataire_id,conversation_id,expediteur_id,contenu,lu) VALUES
(3,1,4,'Salut tu vas bien ?',0),
(3,1,4,'Tu veux faire une petite partie ?',0),
(4,2,7,'Yo yoda ! ça biche ?',0),
(4,2,7,'Toujours premier au classement ! sisi la famille !',0),
(8,3,4,'Coucou !',0),
(8,3,4,'Allez viens coder en Smalltalk. Allez viens. On est bien.',0),
(8,3,4,'Regardes tous ce qu on peut faire. Allez viens !',0);

INSERT INTO partie(partie_id,nom,createur_id,nombre_max_joueurs,tour_joueur_id,publique,map_id,etat) VALUES
(1,"Partie de Yoda 1",4,3,5,0,1,0),
(2,"Partie de Luke",5,2,5,1,1,0),
(3,"Partie de Yoda 2",4,2,5,0,2,0),
/* Parties terminées */
(4,"Partie de Vador 1",2,3,2,0,1,4),
(5,"Partie de Vador 2",2,4,2,0,2,4),
(6,"Partie de Vador 3",2,5,2,1,1,4);

/* Parties presque terminées */
INSERT INTO partie(partie_id,nom,createur_id,nombre_max_joueurs,tour_joueur_id,dernier_tour_joueur_id,publique,map_id,etat) VALUES
(7,"Partie presque terminée",4,2,17,17,1,1,3);

INSERT INTO joueur(joueur_id,user_id,partie_id,score,couleur) VALUES
(1,4,1,0,'vert'),
(2,4,3,0,'vert'),
(3,7,1,0,'rouge'),
(4,5,1,0,'bleu'),
(5,7,2,0,'rouge'),
(6,5,2,0,'bleu'),
(7,7,3,0,'rouge'),
/* joueurs des parties terminées */
(8,2,4,65,'vert'),
(9,3,4,45,'rouge'),
(10,4,4,35,'bleu'),
(11,2,5,35,'vert'),
(12,7,5,95,'rouge'),
(13,3,5,55,'bleu'),
(14,2,6,85,'vert'),
(15,4,6,85,'rouge'),
(16,5,6,90,'bleu');

INSERT INTO joueur(joueur_id,user_id,partie_id,score,jetons,couleur) VALUES
(17,4,7,54,1,'rouge'),
(18,2,7,35,4,'bleu');

INSERT INTO joueur_carte_destination(carte_destination_id,joueur_id,possedee,success) VALUES 
/* partie 4 : Star Wars */
(4,8,1,1),
(5,8,1,1),
(6,9,1,1),
(7,9,1,1),
(8,9,1,1),
(1,10,1,1),
(2,10,1,1),
(3,10,1,1),
/* partie 5 : Pokémon */
(42,11,1,1),
(43,11,1,1),
(44,11,1,1),
(45,11,1,1),
(46,12,1,1),
(47,12,1,1),
(48,12,1,1),
(49,12,1,1),
(50,12,1,1),
(51,13,1,1),
(52,13,1,1),
/* partie 6 : Star Wars */
(20,14,1,1),
(21,14,1,1),
(22,14,1,1),
(23,14,1,1),
(24,15,1,1),
/* partie 7 : Star Wars */
(19, 17, 1, 0),
(27, 17, 1, 0),
(28, 18, 1, 0),
(2, 18, 1, 0),
(20, 18, 1, 0);

INSERT INTO joueur_route(route_id,joueur_id,nb_locomotive) VALUES 
/* partie 4 : Star Wars */
(10,8,0),
(11,8,0),
(12,9,1),
(13,9,2),
(14,9,3),
(15,9,0),
(1,10,4),
(2,10,2),
(3,10,1),
(4,10,0),
(5,10,0),
/* partie 5 : Pokémon */
(56,11,0),
(54,11,0),
(55,11,0),
(50,11,0),
(60,11,1),
(61,11,2),
(63,12,1),
(64,12,1),
(65,12,1),
(61,12,0),
(60,12,0),
(63,12,0),
(45,13,3),
(46,13,1),
(48,13,1),
(47,13,1),
(49,13,1),
/* partie 6 : Star Wars */
(21,14,0),
(2,14,0),
(23,14,0),
(4,14,0),
(5,15,1),
(36,15,0),
(27,15,1),
(38,15,2),
(19,15,0),
/* partie 7 : Star Wars */
(35, 17, 0),
(17, 18, 1),
(20, 18, 1),
(33, 17, 1),
(37, 18, 1),
(3, 18, 0),
(15, 17, 1),
(30, 18, 1),
(39, 17, 2),
(5, 18, 0),
(28, 17, 0),
(29, 18, 0),
(22, 18, 1),
(19, 17, 1),
(4, 18, 2),
(13, 17, 0);

INSERT INTO main (wagon_id, joueur_id) VALUES
(3, 17),
(1, 18),
(6, 18),
(7, 17),
(1, 17),
(3, 18),
(7, 17),
(3, 17),
(2, 17),
(5, 18),
(2, 17),
(8, 18),
(3, 17),
(7, 18),
(5, 18),
(5, 18);

INSERT INTO pioche (partie_id, wagon_id, nombre) VALUES
(7, 1, 10),
(7, 2, 8),
(7, 3, 7),
(7, 4, 12),
(7, 5, 8),
(7, 6, 10),
(7, 7, 9),
(7, 8, 11),
(7, 9, 14);

INSERT INTO pioche_visible (wagon_id, partie_id) VALUES
(2, 7),
(9, 7),
(5, 7),
(6, 7),
(3, 7);

SET FOREIGN_KEY_CHECKS=1; 