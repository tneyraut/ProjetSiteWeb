<?php

class Ville extends Model
{   
    public static function getVillesPlusUtiliseesByMap($map_id)
    {
        $routes = parent::exec('VILLES_PLUS_UTILISEES_BY_MAP', array(':map_id' => $map_id));
        
        $villesReliees = array();
        foreach($routes as $route)
        {
            if(!isset($villesReliees[$route->ville1]))
                $villesReliees[$route->ville1] = 0;
            
            if(!isset($villesReliees[$route->ville2]))
                $villesReliees[$route->ville2] = 0;
            
            $villesReliees[$route->ville1]++;
            $villesReliees[$route->ville2]++;
        }
        
        return $villesReliees;
    }
    
}