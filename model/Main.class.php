<?php

class Main extends Model
{
    
    public static function addWagon($joueur_id, $wagon_id)
    {
        parent::exec('ADD_WAGON', array(':joueur_id' => $joueur_id, ':wagon_id' => $wagon_id));
    }
    
    public static function getCartes($joueur_id)
    {
        return parent::exec('GET_CARTES_MAIN', array(':joueur_id' => $joueur_id));
    }
    
    public static function removeForConstruction($partie_id, $joueur, $type, $nb, $longueur)
    {
        $nombreASupprimer = $nb > $longueur ? $longueur : $nb;
        // On supprime les wagons de la main
        parent::exec('REMOVE_WAGONS', array(':joueur_id' => $joueur->joueur_id, ':type' => $type, ':nb' => (int) $nombreASupprimer));
        
        // On les remet dans la pioche
        Pioche::remettreCartesDefaussees($partie_id, $type, $nombreASupprimer);
        
        if($nb < $longueur)
        {
            // On supprime eventuellement des locomotives
            parent::exec('REMOVE_WAGONS', array(':joueur_id' => $joueur->joueur_id, ':type' => 'locomotive', ':nb' => ($longueur - $nb)));
            // qu'on remet dans la pioche
            Pioche::remettreCartesDefaussees($partie_id, 'locomotive', $longueur - $nb);
        }
    }
    
    public static function supprimerMainByJoueur($joueur_id)
    {
        parent::exec('SUPPRIMER_MAIN_BY_JOUEUR', array(':joueur_id' => $joueur_id));
    }
    
}
