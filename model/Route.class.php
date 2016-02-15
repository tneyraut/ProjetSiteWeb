<?php

class Route extends Model
{
    
    public static function getById($route_id)
    {
        $route = parent::exec('ROUTE_BY_ID', array(':route_id' => $route_id));
    
        if(count($route) > 0)
            return $route[0];
        
        return NULL;
    }
    
    public static function getRoutesByMap($partie_id, $map_id)
    {
        $routes = parent::exec('ROUTES_BY_MAP', array(':map_id' => $map_id));

        for($i = 0; $i < count($routes); $i++)
        {
            $routes[$i]->proprietaire = Route::getProprietaire($partie_id, $routes[$i]->route_id);
        }
        return $routes;
    }
    
    public static function getProprietaire($partie_id, $route_id)
    {
        $joueurs = parent::exec('ROUTE_PROPRIETAIRE', array(':partie_id' => $partie_id, ':route_id' => $route_id));
    
        if(count($joueurs) > 0)
            return $joueurs[0];
        
        return NULL;
    }
    
    public static function construireRoute($joueur_id, $route_id, $nb_locomotive)
    {
        parent::exec('CONSTRUIRE_ROUTE', array(
            ':joueur_id' => $joueur_id,
            ':route_id' => $route_id,
            ':nb_locomotive' => $nb_locomotive));
        
        $route = Route::getById($route_id);
        Joueur::removeJetons($joueur_id, $route->longueur);
        
        $scoreByLongueur = array(
            1 => 1,
            2 => 2,
            3 => 4,
            4 => 7,
            5 => 10,
            6 => 15);
        
        Joueur::incrementeScore($joueur_id, $scoreByLongueur[$route->longueur]);
    }
    
    public static function supprimerJoueurRouteByPartie($partie_id)
    {
        parent::exec('SUPPRIMER_JOUEUR_ROUTE_BY_PARTIE', array(':partie_id' => $partie_id));
    }
    
    public static function getByJoueur($joueur_id)
    {
        return parent::exec('GET_BY_JOUEUR', array(':joueur_id' => $joueur_id));
    }


    public static function getRoutesGroupByJoueurs($joueurs) 
    {
        $routes = array();
        foreach($joueurs as $joueur)
            $routes[$joueur->joueur_id] = parent::exec('GET_BY_JOUEUR', array(':joueur_id' => $joueur->joueur_id));
        
        return $routes;
    }
    
}
