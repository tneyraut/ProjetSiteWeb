/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  01/04/2015 11:49:56                      */
/*==============================================================*/

SET FOREIGN_KEY_CHECKS=0; 

drop table if exists ami;

drop table if exists carte_destination;

drop table if exists conversation;

drop table if exists invitation;

drop table if exists joueur;

drop table if exists joueur_carte_destination;

drop table if exists joueur_route;

drop table if exists main;

drop table if exists map;

drop table if exists message;

drop table if exists partie;

drop table if exists pioche;

drop table if exists pioche_visible;

drop table if exists route;

drop table if exists user;

drop table if exists ville;

drop table if exists wagon;

/*==============================================================*/
/* Table : ami                                                  */
/*==============================================================*/
create table ami
(
   ami_id               int not null auto_increment,
   user_id              int not null,
   user_ami_id          int not null,
   accepter             bool not null,
   primary key (ami_id)
);

/*==============================================================*/
/* Table : carte_destination                                    */
/*==============================================================*/
create table carte_destination
(
   carte_destination_id int not null auto_increment,
   ville1_id            int not null,
   ville2_id            int not null,
   map_id               int not null,
   nombre_points        int not null,
   primary key (carte_destination_id)
);

/*==============================================================*/
/* Table : conversation                                         */
/*==============================================================*/
create table conversation
(
   conversation_id      int not null auto_increment,
   locuteur1_id         int not null,
   locuteur2_id         int not null,
   conversation_name    varchar(255),
   primary key (conversation_id)
);

/*==============================================================*/
/* Table : invitation                                           */
/*==============================================================*/
create table invitation
(
   invitation_id        int not null auto_increment,
   partie_id            int not null,
   inviteur_id          int not null,
   invite_id            int not null,
   accepter             bool not null,
   primary key (invitation_id)
);

/*==============================================================*/
/* Table : joueur                                               */
/*==============================================================*/
create table joueur
(
   joueur_id            int not null auto_increment,
   user_id              int not null,
   partie_id            int not null,
   score                int not null,
   jetons               int default 30,
   couleur              varchar(255) not null,
   primary key (joueur_id)
);

/*==============================================================*/
/* Table : joueur_carte_destination                             */
/*==============================================================*/
create table joueur_carte_destination
(
   joueur_carte_destination_id int not null auto_increment,
   carte_destination_id int not null,
   joueur_id            int not null,
   possedee             bool not null,
   success              bool not null,
   primary key (joueur_carte_destination_id)
);

/*==============================================================*/
/* Table : joueur_route                                         */
/*==============================================================*/
create table joueur_route
(
   joueur_route_id      int not null auto_increment,
   route_id             int,
   joueur_id            int not null,
   nb_locomotive        int not null,
   primary key (joueur_route_id)
);

/*==============================================================*/
/* Table : main                                                 */
/*==============================================================*/
create table main
(
   main_id              int not null auto_increment,
   wagon_id             int not null,
   joueur_id            int not null,
   primary key (main_id)
);

/*==============================================================*/
/* Table : map                                                  */
/*==============================================================*/
create table map
(
   map_id               int not null auto_increment,
   nom                  varchar(255) not null,
   image                varchar(255) not null,
   image_pioche         varchar(255) not null,
   image_carte_destination varchar(255) not null,
   image_fond_carte_destination varchar(255) not null,
   primary key (map_id)
);

/*==============================================================*/
/* Table : message                                              */
/*==============================================================*/
create table message
(
   message_id           int not null auto_increment,
   destinataire_id      int not null,
   conversation_id      int not null,
   expediteur_id        int not null,
   contenu              varchar(255) not null,
   lu                   bool not null,
   primary key (message_id)
);

/*==============================================================*/
/* Table : partie                                               */
/*==============================================================*/
create table partie
(
   partie_id            int not null auto_increment,
   nom                  varchar(255) not null,
   createur_id          int not null,
   map_id               int not null,
   nombre_cartes_piochees int not null,
   nombre_max_joueurs   int not null,
   publique             bool not null,
   etat                 tinyint not null,
   tour_joueur_id       int not null,
   dernier_tour_joueur_id int not null,
   primary key (partie_id)
);

/*==============================================================*/
/* Table : pioche                                               */
/*==============================================================*/
create table pioche
(
   pioche_id            int not null auto_increment,
   partie_id            int not null,
   wagon_id             int not null,
   nombre               int not null,
   primary key (pioche_id)
);

/*==============================================================*/
/* Table : pioche_visible                                       */
/*==============================================================*/
create table pioche_visible
(
   pioche_visible_id    int not null auto_increment,
   wagon_id             int not null,
   partie_id            int not null,
   primary key (pioche_visible_id)
);

/*==============================================================*/
/* Table : route                                                */
/*==============================================================*/
create table route
(
   route_id             int not null auto_increment,
   ville1_id            int not null,
   ville2_id            int not null,
   map_id               int not null,
   longueur             int not null,
   couleur              varchar(255) not null,
   type                 varchar(255) not null,
   stroke_dasharray     varchar(255) not null,
   points               varchar(255) not null,
   primary key (route_id)
);

/*==============================================================*/
/* Table : user                                                 */
/*==============================================================*/
create table user
(
   user_id              int not null auto_increment,
   login                varchar(255) not null,
   password             varchar(255) not null,
   nombre_parties_gagnees int not null,
   nombre_parties_perdues int not null,
   nationalite          varchar(255) not null,
   sexe                 varchar(255) not null,
   age                  int not null,
   ville_de_naissance   varchar(255) not null,
   prenom               varchar(255) not null,
   nom                  varchar(255) not null,
   mail                 longtext not null,
   admin                bool not null,
   primary key (user_id)
);

/*==============================================================*/
/* Table : ville                                                */
/*==============================================================*/
create table ville
(
   ville_id             int not null auto_increment,
   map_id               int not null,
   nom                  varchar(255) not null,
   primary key (ville_id)
);

/*==============================================================*/
/* Table : wagon                                                */
/*==============================================================*/
create table wagon
(
   wagon_id             int not null auto_increment,
   map_id               int not null,
   type                 varchar(255) not null,
   image                varchar(255) not null,
   nb_initial           int not null,
   primary key (wagon_id)
);

/**********************************MODIF REALISEE : REMPLACEMENT DE restrict PAR cascade**************************************/

alter table ami add constraint fk_association_19 foreign key (user_id)
      references user (user_id) on delete cascade on update cascade;

alter table ami add constraint fk_association_20 foreign key (user_ami_id)
      references user (user_id) on delete cascade on update cascade;

alter table carte_destination add constraint fk_association_3 foreign key (ville2_id)
      references ville (ville_id) on delete cascade on update cascade;

alter table carte_destination add constraint fk_association_4 foreign key (map_id)
      references map (map_id) on delete cascade on update cascade;

alter table carte_destination add constraint fk_est_compose foreign key (ville1_id)
      references ville (ville_id) on delete cascade on update cascade;

alter table conversation add constraint fk_association_21 foreign key (locuteur2_id)
      references ami (ami_id) on delete cascade on update cascade;

alter table conversation add constraint fk_association_22 foreign key (locuteur1_id)
      references ami (ami_id) on delete cascade on update cascade;

alter table invitation add constraint fk_association_16 foreign key (partie_id)
      references partie (partie_id) on delete cascade on update cascade;

alter table invitation add constraint fk_association_17 foreign key (invite_id)
      references user (user_id) on delete cascade on update cascade;

alter table invitation add constraint fk_association_18 foreign key (inviteur_id)
      references user (user_id) on delete cascade on update cascade;

alter table joueur add constraint fk_association_12 foreign key (partie_id)
      references partie (partie_id) on delete cascade on update cascade;

alter table joueur add constraint fk_association_13 foreign key (user_id)
      references user (user_id) on delete cascade on update cascade;

alter table joueur_carte_destination add constraint fk_association_26 foreign key (joueur_id)
      references joueur (joueur_id) on delete cascade on update cascade;

alter table joueur_carte_destination add constraint fk_association_27 foreign key (carte_destination_id)
      references carte_destination (carte_destination_id) on delete cascade on update cascade;

alter table joueur_route add constraint fk_association_6 foreign key (route_id)
      references route (route_id) on delete cascade on update cascade;

alter table joueur_route add constraint fk_association_7 foreign key (joueur_id)
      references joueur (joueur_id) on delete cascade on update cascade;

alter table main add constraint fk_association_29 foreign key (wagon_id)
      references wagon (wagon_id) on delete cascade on update cascade;

alter table main add constraint fk_association_30 foreign key (joueur_id)
      references joueur (joueur_id) on delete cascade on update cascade;

alter table message add constraint fk_association_23 foreign key (conversation_id)
      references conversation (conversation_id) on delete cascade on update cascade;

alter table message add constraint fk_association_24 foreign key (destinataire_id)
      references ami (ami_id) on delete cascade on update cascade;

alter table message add constraint fk_association_25 foreign key (expediteur_id)
      references ami (ami_id) on delete cascade on update cascade;

alter table partie add constraint fk_association_14 foreign key (createur_id)
      references user (user_id) on delete cascade on update cascade;

alter table partie add constraint fk_association_15 foreign key (map_id)
      references map (map_id) on delete cascade on update cascade;

alter table pioche add constraint fk_association_31 foreign key (partie_id)
      references partie (partie_id) on delete cascade on update cascade;

alter table pioche add constraint fk_association_32 foreign key (wagon_id)
      references wagon (wagon_id) on delete cascade on update cascade;

alter table pioche_visible add constraint fk_association_33 foreign key (partie_id)
      references partie (partie_id) on delete cascade on update cascade;

alter table pioche_visible add constraint fk_association_34 foreign key (wagon_id)
      references wagon (wagon_id) on delete cascade on update cascade;

alter table route add constraint fk_association_10 foreign key (ville1_id)
      references ville (ville_id) on delete cascade on update cascade;

alter table route add constraint fk_association_11 foreign key (map_id)
      references map (map_id) on delete cascade on update cascade;

alter table route add constraint fk_association_9 foreign key (ville2_id)
      references ville (ville_id) on delete cascade on update cascade;

alter table ville add constraint fk_association_5 foreign key (map_id)
      references map (map_id) on delete cascade on update cascade;

alter table wagon add constraint fk_association_35 foreign key (map_id)
      references map (map_id) on delete cascade on update cascade;

SET FOREIGN_KEY_CHECKS=1;