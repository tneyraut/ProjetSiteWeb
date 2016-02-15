<?php

class Partie extends Model
{
    public static function getNombreCartesPiochees($partie_id)
    {
        $partie = parent::exec('GET_NOMBRE_CARTES_PIOCHEES', array(':partie_id' => $partie_id));
        if(count($partie) > 0)
        {
            return $partie[0]->nombre_cartes_piochees;
        }
        return NULL;
    }
    
    public static function getPartieDescription($partie_id)
    {
        $partie = parent::exec('PARTIE_DESCRIPTION', array(':partie_id' => $partie_id));
        if(count($partie) > 0)
        {
            return $partie[0];
        }
        return NULL;
    }
    
    public static function lancer($partie_id, $tourPremierJoueur)
    {
        parent::exec('CHANGER_ETAT', array(':partie_id' => $partie_id, ':etat' => 1));
        
        parent::exec('SET_TOUR', array(':partie_id' => $partie_id, ':tourPremierJoueur' => $tourPremierJoueur));
    }
    
    public static function changerEtat($partie_id, $etat)
    {
        parent::exec('CHANGER_ETAT', array(':partie_id' => $partie_id, ':etat' => $etat));
    }
    
    public static function checkFinPremierTour($partie_id)
    {
        $participants = Joueur::getParticipants($partie_id);
        
        $isFini = true;
        foreach($participants as $joueur)
        {
            $cartesDestination = CarteDestination::getCartes($joueur->joueur_id);
            if(count($cartesDestination) == 0) // Si on a pas encore pioché
            {
                $isFini = false;
            }
        }
        
        if($isFini)
            Partie::changerEtat($partie_id, 2);
    }
    
    public static function isLancee($partie_id)
    {
        $isLancee = parent::exec('IS_LANCEE', array(':partie_id' => $partie_id));
        
        return $isLancee[0]->etat != 0;
    }
    
    public static function isMyTurn($partie_id, $user_id)
    {
        $partie = parent::exec('PARTIE_BY_ID', array(':partie_id' => $partie_id));
        $partie = $partie[0];
        $joueur = Joueur::getByUserId($partie_id, $user_id);

        return $partie->tour_joueur_id === $joueur->joueur_id;
    }
    
    public static function terminerTour($partie_id)
    {
        $partie = parent::exec('PARTIE_BY_ID', array(':partie_id' => $partie_id));
        $partie = $partie[0];
        
        $participants = Joueur::getParticipants($partie_id);
        
        $i = 0;
        while($participants[$i]->joueur_id !== $partie->tour_joueur_id)
            $i++;
        
        $joueurSuivantId = $participants[(++$i%count($participants))]->joueur_id;
        
        // Si le dernier tour est fini
        if($partie->etat == 3 && $partie->dernier_tour_joueur_id == $partie->tour_joueur_id)
        {
            Partie::changerEtat($partie_id, 4);
            static::calculResultats($partie_id);
        }
        else
        {
            $joueur = Joueur::getById($partie->tour_joueur_id);
            // Si le joueur n'a presque plus de jetons, on passe a dernier tour
            if($partie->etat != 3 && $joueur->jetons <= 2)
            {
                Partie::dernierTour($partie_id, $joueur->joueur_id);
            }

            parent::exec('PARTIE_AU_SUIVANT', array(':partie_id' => $partie_id, 'tour_joueur_id' => $joueurSuivantId));
        }
        
    }
    
    public static function dernierTour($partie_id, $joueur_id)
    {
        parent::exec('PARTIE_DERNIER_TOUR', array(':partie_id' => $partie_id, ':joueur_id' => $joueur_id));
    }
    
    public static function incrementerCartesPiochees($partie_id, $nb)
    {
        parent::exec('INCREMENTER_PIOCHE', array(':partie_id' => $partie_id, ':nb' => $nb));
    }
    
    public static function getPartieEnCoursCreation($id)
    {
        $partiesEnCreation = parent::exec('PARTIE_EN_COURS_CREATION_BY_USER_ID', array(':id' => $id));
        if(count($partiesEnCreation) > 0)
        {
            return $partiesEnCreation;
        }
        return NULL;
    }

    public static function getPartieEnCours($id)
    {
        $partiesEnCours = parent::exec('PARTIE_EN_COURS_BY_USER_ID', array(':id' => $id));
        if(count($partiesEnCours) > 0)
        {
            return $partiesEnCours;
        }
        return NULL;
    }

    public static function getPartieInvitation($id)
    {
        $partiesInvitations = parent::exec('PARTIE_INVITATION_BY_USER_ID', array(':id' => $id));
        if(count($partiesInvitations) > 0)
        {
            return $partiesInvitations;
        }
        return NULL;
    }
    
    public static function getPartiesTerminees($user_id)
    {
        $partiesTerminees = parent::exec('PARTIE_TERMINEES_BY_USER_ID', array(':id' => $user_id));
        if(count($partiesTerminees) > 0)
        {
            return $partiesTerminees;
        }
        return NULL;
    }

    public static function getListePartiePublique()
    {
        $partiesPubliques = parent::exec('LISTE_PARTIE_PUBLIQUE', array());
        if(count($partiesPubliques) > 0)
        {
            return $partiesPubliques;
        }
        return NULL;
    }
    
    public static function getNombrePartiesJouees()
    {
        return parent::exec('NOMBRE_PARTIES_JOUEES', array());
    }
    
    public static function getNombrePartiesTerminees()
    {
        return parent::exec('NOMBRE_PARTIES_TERMINEES', array());
    }
    
    public static function getNombrePartiesEnCours()
    {
        return parent::exec('NOMBRE_PARTIES_EN_COURS', array());
    }
    
    public static function creerPartie($nom, $nombreJoueurs,$map_id,$partiePublique,$user_id)
    {
        if ($partiePublique == "Oui") {
            $partiePublique = 1;
        }
        else {
            $partiePublique = 0;
        }
        parent::exec('CREER_PARTIE', array(
            ':nom' => $nom,
            ':nombreJoueurs' => $nombreJoueurs,
            ':map_id' => $map_id,
            ':publique' => $partiePublique,
            ':createur_id' => $user_id
            ));
    }
    
    public static function getPartieID()
    {
        return parent::exec('PARTIE_ID', array());
    }
    
    public static function ajouterInvitation($partie_id,$inviteur_id,$invite_id)
    {
        parent::exec('AJOUTER_INVITATION', array(':partie_id' => $partie_id,
            ':inviteur_id' => $inviteur_id,
            ':invite_id' => $invite_id
            ));
    }
    
    public static function accepterInvitation($invitation_id)
    {
        parent::exec('ACCEPTER_INVITATION', array(':id' => $invitation_id));
    }
    
    public static function refuserInvitation($idInvitation)
    {
        parent::exec('REFUSER_INVITATION', array(':idInvitation' => $idInvitation));
    }
    
    public static function supprimerInvitationsBySuppressionUser($id)
    {
        parent::exec('SUPPRIMER_INVITATIONS_BY_USER_SUPPRESSION', array(':id' => $id));
    }
    
    public static function getPartieByUser($id)
    {
        return parent::exec('PARTIE_BY_USER', array(':id' => $id));
    }
    
    public static function supprimerPartieById($id)
    {
        parent::exec('SUPPRIMER_PARTIE_BY_ID', array(':id' => $id));
    }
    
    public static function supprimerInvitationByPartie($partie_id)
    {
        parent::exec('SUPPRIMER_INVITATION_BY_PARTIE', array(':partie_id' => $partie_id));
    }
    
    public static function getNombreJoueursMoyenParPartie()
    {
        $nombre_de_joueurs_moyen = parent::exec('NOMBRE_JOUEURS_MOYEN_PAR_PARTIE', array());
        if ($nombre_de_joueurs_moyen != NULL) {
            return $nombre_de_joueurs_moyen[0]->nombre_de_joueurs_moyen;
        }
        return NULL;
    }
    
    public static function getNombrePartiesByMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_PARTIES_BY_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->nombreParties;
        }
        return NULL;
    }
    
    public static function getNombrePartiesEnCoursByMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_PARTIES_EN_COURS_BY_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->nombrePartiesEnCours;
        }
        return NULL;
    }
    
    public static function getNombrePartiesTermineesByMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_PARTIES_TERMINEES_BY_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->nombrePartiesTerminees;
        }
        return NULL;
    }
    
    public static function getNombreMoyenJoueursByPartieAndMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_MOYEN_JOUEURS_BY_PARTIE_AND_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->nombreJoueurs;
        }
        return NULL;
    }
    
    public static function getNombreMoyenJokersByPartie()
    {
        $resultat = parent::exec('NOMBRE_MOYEN_JOKERS_BY_PARTIE', array());
        if ($resultat != NULL) {
            return $resultat[0]->resultat;
        }
        return NULL;
    }
    
    public static function getNombreMoyenJokersByPartieAndMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_MOYEN_JOKERS_BY_PARTIE_AND_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->resultat;
        }
        return NULL;
    }
    
    public static function getNombreMoyenCartesDestinationReussiesByPartie()
    {
        $resultat = parent::exec('NOMBRE_MOYEN_CARTES_DESTINATION_REUSSIES_BY_PARTIE', array());
        if ($resultat != NULL) {
            return $resultat[0]->resultat;
        }
        return NULL;
    }
    
    public static function getNombreMoyenCartesDestinationReussiesByPartieAndMapId($map_id)
    {
        $resultat = parent::exec('NOMBRE_MOYEN_CARTES_DESTINATION_REUSSIES_BY_PARTIE_AND_MAP_ID', array(':map_id' => $map_id));
        if ($resultat != NULL) {
            return $resultat[0]->resultat;
        }
        return NULL;
    }
    
    public static function calculResultats($partie_id)
    {
        $joueurs = Joueur::getParticipants($partie_id);
        $routes = Route::getRoutesGroupByJoueurs($joueurs);

        // Validation des cartes destination de chaque joueur
        foreach($joueurs as $i => $joueur)
        {
            $cartesDestination = CarteDestination::getCartes($joueur->joueur_id);
            $routesDuJoueur = $routes[$joueur->joueur_id];

            $joueurs[$i]->score += static::validerCartesDestination($cartesDestination, $routesDuJoueur);
        }

        // Augmentation du score du joueur ayant effectué le chemin le plus long
        $ids_des_joueurs = static::getJoueursIdCheminLePlusLong($joueurs, $routes);
        $meilleurScore = $joueurs[0]->score;
        foreach($joueurs as $i => $joueur)
        {
            if(in_array($joueur->joueur_id, $ids_des_joueurs))
                $joueurs[$i]->score += 10;
            
            if($joueurs[$i]->score > $meilleurScore)
                $meilleurScore = $joueurs[$i]->score;
            
            Joueur::setScore($joueur->joueur_id, $joueur->score);
        }
        
        foreach($joueurs as $joueur)
        {
            if($joueur->score == $meilleurScore)
                User::incrementePartiesGagnees($joueur->user_id);
            else
                User::incrementePartiesPerdues($joueur->user_id);
        }
    }
    
    
    public static function validerCartesDestination($cartesDestination, $routes)
    {
        $score = 0;
        foreach($cartesDestination as $carteDestination)
        {
            if(static::sontReliees($carteDestination->ville1, $carteDestination->ville2, $routes))
                $score += $carteDestination->nombre_points;
            else
                $score -= $carteDestination->nombre_points;
        }
        
        return $score;
    }
    
    public static function sontReliees($ville1, $ville2, $routes)
    {
        $routesContenantVille1 = static::getRoutesByVille($ville1, $routes);
        
        foreach($routesContenantVille1 as $route)
        {
            if($route->ville2 == $ville2)
                return true;
            
            if(static::sontReliees($route->ville2, $ville2, static::removeRouteByVilles($route->ville1, $route->ville2, $routes)))
                return true;
        }
        
        return false;
    }
    
    public static function getRoutesByVille($ville1, $routes)
    {
        $routesContenantVille1 = array();
        foreach($routes as $i => $route)
        {
            if($route->ville1 == $ville1)
                $routesContenantVille1[] = $route;
            
            if($route->ville2 == $ville1)
            {
                $ville2Route = $route->ville2;
                $routes[$i]->ville2 = $route->ville1;
                $routes[$i]->ville1 = $ville2Route;
                $routesContenantVille1[] = $routes[$i];
            }
        }
        
        return $routesContenantVille1;
    }
    
    public static function removeRouteByVilles($ville1, $ville2, $routes)
    {
        $res = array();
        
        foreach($routes as $route)
        {
            if(!($route->ville1 == $ville1 && $route->ville2 == $ville2) && !($route->ville1 == $ville2 && $route->ville2 == $ville1))
                $res[] = $route;
        }
        
        return $res;
    }
    
    
    public static function getJoueursIdCheminLePlusLong($joueurs, $routes)
    {
        $ids_des_joueurs = array();
        $longueurMax = 0;
        foreach($joueurs as $joueur)
        {
            $routesDuJoueur = $routes[$joueur->joueur_id];
            
            $longueurMaxJoueur = static::longueurCheminMax($routesDuJoueur);
            
            if($longueurMaxJoueur > $longueurMax)
            {
                $longueurMax = $longueurMaxJoueur;
                $ids_des_joueurs = array();
                $ids_des_joueurs[] = $joueur->joueur_id;
            }
            else if($longueurMaxJoueur == $longueurMax)
            {
                $ids_des_joueurs[] = $joueur->joueur_id;
            }
        }
        
        return $ids_des_joueurs;
    }
    
    public static function longueurCheminMax($routes)
    {
        $villes = static::listeVilles($routes);
        
        if(count($routes) == 0)
            return 0;
        
        $longueurMax = 0;
        foreach($villes as $ville)
        {
            $longueur = static::longueurMaxEnPartantDe($ville, $routes);
            
            if($longueur > $longueurMax)
                $longueurMax = $longueur;
        }
        
        return $longueurMax;
    }
    
    public static function longueurMaxEnPartantDe($ville, $routes)
    {
        $longueurMax = 0;
        
        $routesContenantLaVille = static::getRoutesByVille($ville, $routes);
        foreach($routesContenantLaVille as $route)
        {
            $nouvellesRoutes = static::removeRouteByVilles($ville, $route->ville2, $routes);
            $longueur = $route->longueur+static::longueurMaxEnPartantDe($route->ville2, $nouvellesRoutes);
            
            if($longueur > $longueurMax)
                $longueurMax = $longueur;
        }
        
        return $longueurMax;
    }
    
    public static function listeVilles($routes)
    {
        $listeVilles = array();
        foreach($routes as $route)
        {
            if(!in_array($route->ville1, $listeVilles))
                $listeVilles[] = $route->ville1;
            
            if(!in_array($route->ville2, $listeVilles))
                $listeVilles[] = $route->ville2;
        }
        
        return $listeVilles;
    }
    
}