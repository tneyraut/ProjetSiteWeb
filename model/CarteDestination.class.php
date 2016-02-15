<?php

function my_sort($a, $b) 
{
    if ($a->nombre_points == $b->nombre_points)
            return 0;

    return ($a->nombre_points < $b->nombre_points)?-1:1;
}
        
class CarteDestination extends Model
{
    
    public static function getCartes($joueur_id)
    {
        return parent::exec('GET_CARTES_DESTINATION', array(':joueur_id' => $joueur_id));
    }
    
    public static function getCartesPiochees($joueur_id)
    {
        return parent::exec('GET_CARTES_PIOCHEES', array(':joueur_id' => $joueur_id));
    }
    
    public static function piocher3Cartes($partie_id, $map_id)
    {
        $piocheCartesDestination = parent::exec('GET_PIOCHE_CARTE_DESTINATION', array(':partie_id' => $partie_id, ':map_id' => $map_id));

        $cartes = array();
        $nb = min(3, count($piocheCartesDestination));
        for($i=0; $i<$nb; $i++)
        {
            $index = rand(0, count($piocheCartesDestination)-1);
            
            $cartes[] = $piocheCartesDestination[$index];
            
            unset($piocheCartesDestination[$index]);
            $piocheCartesDestination = array_values($piocheCartesDestination);
        }
        
        uasort($cartes,"my_sort");

        return $cartes;
    }
    
    public static function donnerCarteDestination($joueur_id, $carte_id, $possedee)
    {
        parent::exec('ADD_CARTE_DESTINATION', array(':joueur_id' => $joueur_id, ':carte_destination_id' => $carte_id, ':possedee' => $possedee));
    }
    
    public static function clearCartesPiochees($joueur_id)
    {
        parent::exec('CLEAR_CARTES_NON_POSSEDEES', array(':joueur_id' => $joueur_id));
    }
    
    public static function supprimerJoueurCarteDestinationByJoueur($joueur_id)
    {
        parent::exec('SUPPRIMER_JOUEUR_CARTER_DESTINATION_BY_JOUEUR', array(':joueur_id' => $joueur_id));
    }
    
    public static function getCartesDestinationPlusUtiliseesByMap($map_id)
    {
        return parent::exec('CARTES_DESTINATION_LES_PLUS_UTILISEES_BY_MAP', array(':map_id' => $map_id));
    }
    
    public static function getCartesDestinationPlusReussiesByMap($map_id)
    {
        return parent::exec('CARTES_DESTINATION_LES_PLUS_REUSSIES_BY_MAP', array(':map_id' => $map_id));
    }
}

