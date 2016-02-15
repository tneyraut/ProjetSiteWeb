<?php

class PartieController extends Controller
{
    
    public function defaultAction()
    {
        $response = new Response();
        
        $response->redirect('gestionParties');
        
        return $response;
    }
    
    public function demarrerAction($partie_id)
    {
        $response = new Response();
        
        if(!Partie::isLancee($partie_id))
        {
            $participants = Joueur::getParticipants($partie_id);
            if(count($participants) < 2) 
            {
                $response->redirect('gestionParties', 'salleAttente', array($partie_id));
                return $response;
            }
            
            $map = Map::getMap($partie_id);

            $wagons = Wagon::getWagonsByMap($map->map_id);

            // initialisation du paquet de cartes wagons
            foreach($wagons as $wagon)
            {
                Pioche::initialiserPioche($partie_id, $wagon->wagon_id, $wagon->nb_initial);
            }

            $participants = Joueur::getParticipants($partie_id);
            foreach($participants as $joueur)
            {
                // 4 cartes wagon par joueur
                for($i = 0; $i < 4; $i++)
                {
                    $carte = Pioche::piocher($partie_id);
                    Main::addWagon($joueur->joueur_id, $carte->wagon_id);
                }
                
                $cartes = CarteDestination::piocher3Cartes($partie_id, $map->map_id);
                foreach($cartes as $carte)
                    CarteDestination::donnerCarteDestination($joueur->joueur_id, $carte->carte_destination_id, false);
            }

            for($i = 0; $i < 5; $i++)
            {
                $carte = Pioche::piocher($partie_id);
                PiocheVisible::addWagon($partie_id, $carte->wagon_id);
            }

            Partie::lancer($partie_id, $participants[0]->joueur_id);
        }
        
        $response->redirect('partie', 'choisirCarteDestination', array($partie_id));
        
        return $response;
    }
    
    
    /*
     * La partie a 5 états :
     * - 0 : partie non démarrée
     * - 1 : partie démarrer, chaque joueur doit choisir 2 cartes destination
     * - 2 : partie en cours, phase de jeu ou les participants jouent chacun leur tour
     * - 3 : dernier tour : un des participants n'a presque plus de jetons
     * - 4 : partie terminée
     */
    public function plateauAction($partie_id)
    {
        $response = new Response();
        
        $partie = Partie::getPartieDescription($partie_id);
        $joueur = Joueur::getByUserId($partie_id, $this->user->user_id);
        
        if($partie->etat == 1) // Premier tour ou on pioche les cartes destinations (2 min)
        {
            $cartesDestination = CarteDestination::getCartes($joueur->joueur_id);
            if(count($cartesDestination) == 0) // Si on a pas encore pioché
            {
                $response->redirect('partie', 'piocher', array($partie_id, 'carte_destination'));
                return $response;
            }
            //sinon on attend que les autres piochent
        }
        
        if($partie->etat != 0 && $partie->etat != 4)
        {
            $map = Map::getMap($partie_id);
            $this->view->setArg('map', $map);
            
            $this->view->render('partie/plateau', array('partie_id' => $partie_id));
        }
        else if($partie->etat == 4)
        {
            $response->redirect('partie', 'resultats', array($partie_id));
        }
        else
        {
            $response->redirect('gestionParties', 'salleAttente', array($partie_id));
        }
        
        return $response;
    }
    
    
    
    public function getPlateauAjaxAction($partie_id)
    {
        $response = new Response();
        
        $returned_objects = array();
        
        $partie = Partie::getPartieDescription($partie_id);
        $returned_objects['partie'] = $partie;
        
        $joueur = Joueur::getByUserId($partie_id, $this->user->user_id);
        $returned_objects['joueur'] = $joueur;
        
        $returned_objects['participants'] = Joueur::getParticipants($partie_id);
        
        $returned_objects['premierTour'] = ($partie->etat == 1);
        
        $returned_objects['dernierTour'] = ($partie->etat == 3);
                
        $returned_objects['piochePossible'] = ($partie->nombre_cartes_piochees <= 1);

        $returned_objects['isMyTurn'] = ($partie->tour_joueur_id == $joueur->joueur_id);

        $map = Map::getMap($partie_id);
        $returned_objects['map'] = $map;
        
        $routes = Route::getRoutesByMap($partie_id, $partie->map_id);
        $returned_objects['routes'] = $routes;

        $pioche_visible = PiocheVisible::getCartes($partie_id);
        $returned_objects['pioche_visible'] = $pioche_visible;

        $main = Main::getCartes($joueur->joueur_id);
        $returned_objects['main'] = $main;

        $cartesDestination = CarteDestination::getCartes($joueur->joueur_id);
        $returned_objects['cartesDestination'] = $cartesDestination;
        
        $response->ajax($returned_objects);
        
        return $response;
    }
    
    
    
    public function checkActionsJoueur($joueur, $partie_id, &$response)
    {
        $partie = Partie::getPartieDescription($partie_id);

        if($partie->etat == 0 || $partie->etat == 4)
        {
            $response->redirect('gestionParties', 'salleAttente', array($partie_id));
            return false;
        }
        
        // On vérifie que c'est bien le tour du joueur
        if(!Partie::isMyTurn($partie_id, $this->user->user_id) && $partie->etat != 1)
        {
            $response->redirect('partie', 'plateau', array($partie_id));
            return false;
        }
        
        // Si le joueur a dejà demandé de piocher des cartes destination mais a malhonnetment quitté la page de choix
        // On l'oblige à choisir
        $cartesPiochees = CarteDestination::getCartesPiochees($joueur->joueur_id);
        if(count($cartesPiochees) > 0)
        {
            $response->redirect('partie', 'choisirCarteDestination', array($partie_id));
            return false;
        }
        
        if($partie->etat == 1 && count($cartesPiochees) == 0)
        {
            $response->redirect('partie', 'plateau', array($partie_id));
            return false;
        }
        
        return true;
    }
    
    
    
    public function piocherAction($partie_id, $pioche)
    {
        $response = new Response();
        
        $joueur = Joueur::getByUserId($partie_id, $this->user->user_id);
        
        if(!$this->checkActionsJoueur($joueur, $partie_id, $response))
            return $response;
        
        if($pioche === 'carte_destination')
            $response = $this->piocherCarteDestination($partie_id, $joueur);
        else if($pioche === 'pioche')
            $response = $this->piocher($partie_id, $joueur, $pioche);
        else
            $response = $this->piocherCarteVisible($partie_id, $joueur, $pioche);
        
        return $response;
    }
    
    public function piocher($partie_id, $joueur, $pioche)
    {
        $response = new Response();

        $wagon = Pioche::piocher($partie_id);
        Partie::incrementerCartesPiochees($partie_id,1);
       
        Main::addWagon($joueur->joueur_id, $wagon->wagon_id);
        
        $nombre_cartes_piochees = Partie::getNombreCartesPiochees($partie_id);
        if($nombre_cartes_piochees >= 2)
            Partie::terminerTour($partie_id);

        $response->redirect('partie', 'plateau', array($partie_id));
        
        return $response;
    }
    
    public function piocherCarteVisible($partie_id, $joueur, $pioche)
    {
        $response = new Response();
         
        $nombre_cartes_piochees = Partie::getNombreCartesPiochees($partie_id);
        
        if($pioche === 'locomotive' && $nombre_cartes_piochees == 0)
        {
            $wagon = PiocheVisible::piocherType($partie_id, $pioche);

            if($wagon)
            {
                Partie::incrementerCartesPiochees($partie_id,2);
            }
            else
            {
                $this->view->render('partie/erreur', array('partie_id' => $partie_id,
                'erreur' => 'Vous ne pouvez pas prendre cette carte.'));
                return $response;
            }
        }
        else if($pioche !== 'locomotive')
        {
            $wagon = PiocheVisible::piocherType($partie_id, $pioche);

            if($wagon)
            {
                Partie::incrementerCartesPiochees($partie_id,1);
            }
            else
            {
                $this->view->render('partie/erreur', array('partie_id' => $partie_id,
                'erreur' => 'Vous ne pouvez pas prendre cette carte.'));
                return $response;
            }
        }
        else
        {
            $this->view->render('partie/erreur', array('partie_id' => $partie_id,
            'erreur' => 'Vous ne pouvez pas prendre de locomotive.'));
            return $response;
        }
        
        Main::addWagon($joueur->joueur_id, $wagon->wagon_id);
        
        $nombre_cartes_piochees = Partie::getNombreCartesPiochees($partie_id);
        if($nombre_cartes_piochees >= 2)
            Partie::terminerTour($partie_id);

        $response->redirect('partie', 'plateau', array($partie_id));
        
        return $response;
    }
    
    public function piocherCarteDestination($partie_id, $joueur)
    {
        $response = new Response();
       
        $map = Map::getMap($partie_id);
        
        $cartes = CarteDestination::piocher3Cartes($partie_id, $map->map_id);
        
        foreach($cartes as $carte)
            CarteDestination::donnerCarteDestination($joueur->joueur_id, $carte->carte_destination_id, false);
        
        $this->view->render('partie/choisirCartesDestination', array(
            'partie_id' => $partie_id,
            'cartes' => $cartes,
            'nbMin' => 1,
            'map' => $map));
        
        return $response;
    }
    
    
    
    public function choisirCarteDestinationAction($partie_id)
    {
        $response = new Response();
        
        $partie = Partie::getPartieDescription($partie_id);
        
        $cartes = $this->request->getPostValue('cartes');
        $joueur = Joueur::getByUserId($partie_id, $this->user->user_id);

        $nbMin = 1;
        
        if($partie->etat == 1)
            $nbMin = 2;
        
        if(!$cartes || count($cartes) == 0 || (count($cartes) < $nbMin && $partie->etat == 1))
        {
            $map = Map::getMap($partie_id);
            
            $cartesPiochees = CarteDestination::getCartesPiochees($joueur->joueur_id);
            $this->view->render('partie/choisirCartesDestination', array(
                'partie_id' => $partie_id,
                'cartes' => $cartesPiochees,
                'nbMin' => $nbMin,
                'map' => $map,
                'erreur' => 'Vous devez garder au moins une carte.'));
            
            return $response;
        }
        
        foreach($cartes as $carte_id)
        {
            CarteDestination::donnerCarteDestination($joueur->joueur_id, $carte_id, true);
        }
        
        CarteDestination::clearCartesPiochees($joueur->joueur_id);
        
        if($partie->etat == 1) // Si c'est le premier tour
        {
            Partie::checkFinPremierTour($partie_id);
        }
        else
        {
            // Lorsque le joueur pioche il doit obligatoirement terminer son tour
            Partie::terminerTour($partie_id);
        }
        
        $response->redirect('partie', 'plateau', array($partie_id));
        
        return $response;
    }
    
    
    
    public function construireRouteAction($partie_id, $route_id, $couleur = NULL)
    {
        $response = new Response();
        
        $joueur = Joueur::getByUserId($partie_id, $this->user->user_id);

        if(!$this->checkActionsJoueur($joueur, $partie_id, $response))
                return $response;
        
        $main = Main::getCartes($joueur->joueur_id);
        $route = Route::getById($route_id);

        if($route->longueur > $joueur->jetons)
        {
            $this->view->render('partie/erreur', array('partie_id' => $partie_id,
                'erreur' => 'Vous n\'avez pas assez de jetons.'));
            
            return $response;
        }
        
        $routesDuJoueur = Route::getByJoueur($joueur->joueur_id);
        foreach($routesDuJoueur as $uneRoute)
        {
            if(($uneRoute->ville1 == $route->ville1 && $uneRoute->ville2 == $route->ville2) || ($uneRoute->ville1 == $route->ville2 && $uneRoute->ville2 == $route->ville1))
            {
                $this->view->render('partie/erreur', array('partie_id' => $partie_id,
                'erreur' => 'Vous possédez déjà la seconde route reliant ces deux villes.'));
            
                return $response;
            }
        }
        
        // Création d'un tableau pour modéliser la main du joueur : array( couleurDeCarte => nombreDeCartesPossedées )
        $nbParCouleur = array();
        foreach($main as $carte)
        {
            if(!isset($nbParCouleur[$carte->type]))
                $nbParCouleur[$carte->type] = 1;
            else
                $nbParCouleur[$carte->type]++;
        }
        
        if($route->couleur !== 'aucune')
        {
            $response = $this->construireRouteDeCouleur($partie_id, $route, $joueur, $nbParCouleur);
        }
        else
        {
            $response = $this->construireRouteGrise($partie_id, $route, $joueur, $nbParCouleur, $couleur);
        }
        
        return $response;
    }
    
    public function construireRouteDeCouleur($partie_id, $route, $joueur, $nbParCouleur)
    {
        $response = new Response();
        
        $nbLocomotives = isset($nbParCouleur['locomotive']) ? $nbParCouleur['locomotive'] : 0;
        
        // Si le joueur possède assez de cartes de la bonne couleur (locomotives inclues)
        if($nbLocomotives >= $route->longueur || (isset($nbParCouleur[$route->couleur]) && $nbParCouleur[$route->couleur]+$nbLocomotives >= $route->longueur))
        {
            Main::removeForConstruction($partie_id, $joueur, $route->couleur, $nbParCouleur[$route->couleur], $route->longueur);
            
            $nb_locomotives = 0;
            if($nbParCouleur[$route->couleur] < $route->longueur)
                    $nb_locomotives = $route->longueur - $nbParCouleur[$route->couleur];
            
            Route::construireRoute($joueur->joueur_id, $route->route_id, $nb_locomotives);
            
            Partie::terminerTour($partie_id);
            
            $response->redirect('partie', 'plateau', array($partie_id));
        }
        else
        {
            $this->view->render('partie/erreur', array('partie_id' => $partie_id,
                'erreur' => 'Vous n\'avez pas assez de cartes de couleur '.$route->couleur.' et de locomotives pour construire cette route.'));
        }
        
        return $response;
    }
    
    public function construireRouteGrise($partie_id, $route, $joueur, $nbParCouleur, $couleur) 
    {
        $response = new Response();
        
        $map = Map::getMap($partie_id);
        
        $nbLocomotives = isset($nbParCouleur['locomotive']) ? $nbParCouleur['locomotive'] : 0;
        
        // Création d'un tableau de cartes wagons de la main du joueur qui peuvent être utilisées pour construire la route
        $possibilites = array();
        foreach($nbParCouleur as $type => $nb)
        {
            if($type === 'locomotive' && $nb >= $route->longueur)
            {
                $possibilites[] = Wagon::getByType($type, $map->map_id);
            }
            else if($type !== 'locomotive' && $nb+$nbLocomotives >= $route->longueur)
            {
                $possibilites[] = Wagon::getByType($type, $map->map_id);
            }
        }
         
        // S'il n'y a qu'un possibilité on l'effectue sans demander confirmation
        if(count($possibilites) === 1)
        {
            Main::removeForConstruction($partie_id, $joueur, $possibilites[0]->type, $nbParCouleur[$possibilites[0]->type], $route->longueur);
            
            $nb_locomotives = 0;
            if($nbParCouleur[$possibilites[0]->type] < $route->longueur)
                $nb_locomotives = $route->longueur - $nbParCouleur[$possibilites[0]->type];
            
            Route::construireRoute($joueur->joueur_id, $route->route_id, $nb_locomotives);
            
            Partie::terminerTour($partie_id);
            
            $response->redirect('partie', 'plateau', array($partie_id));
        }
        else if(count($possibilites) >= 1) // Sinon il faut demander au joueur quelle est la couleur qu'il souhaite utiliser
        {
            if($couleur) // S'il a déjà choisi
            {
                Main::removeForConstruction($partie_id, $joueur, $couleur, $nbParCouleur[$couleur], $route->longueur);
                
                $nb_locomotives = 0;
                if($nbParCouleur[$couleur] < $route->longueur)
                    $nb_locomotives = $route->longueur - $nbParCouleur[$couleur];
                
                Route::construireRoute($joueur->joueur_id, $route->route_id, $nb_locomotives);
                
                Partie::terminerTour($partie_id);
                
                $response->redirect('partie', 'plateau', array($partie_id));
            }
            else // Sinon il faut lui demander
            {
                $this->view->render('partie/choisirCouleur', array('partie_id' => $partie_id, 'route_id' => $route->route_id, 'possibilites' => $possibilites));
            }
        }
        else // Si on arrive ici c'est que le joueur n'a pas assez de cartes pour construire cette route
        {
            $this->view->render('partie/erreur', array('partie_id' => $partie_id,
            'erreur' => 'Vous n\'avez pas assez de carte de même couleur pour construire cette route.'));
        }
        
        return $response;
    }
    
    public function resultatsAction($partie_id) 
    {
        $joueurs = Joueur::getParticipants($partie_id);
        
        $meilleurScore = $joueurs[0]->score;
        $meilleursJoueurs = array();
        foreach($joueurs as $joueur)
        {
            if($joueur->score > $meilleurScore)
            {
                $meilleursJoueurs = array();
                $meilleursJoueurs[] = $joueur;
            }
            else if($joueur->score == $meilleurScore)
            {
                $meilleursJoueurs[] = $joueur;
            }
        }
        
        $gagnant = false;
        foreach($meilleursJoueurs as $joueur) 
        {
            if($joueur->user_id == $this->user->user_id)
                $gagnant = true;
        }
        
        $this->view->render('partie/resultats', array(
                'partie_id' => $partie_id,
                'joueurs' => $joueurs,
                'meilleursJoueurs' => $meilleursJoueurs,
                'gagnant' => $gagnant));
        
        return new Response();
    }
}
