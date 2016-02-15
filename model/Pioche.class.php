<?php

class Pioche extends Model
{
    
    public static function initialiserPioche($partie_id, $wagon_id, $nb)
    {
        parent::exec('INITIALISER_PIOCHE', array(':partie_id' => $partie_id, ':wagon_id' => $wagon_id, ':nb' => $nb));
    }
    
    public static function piocher($partie_id)
    {
        $wagons = parent::exec('GET_ALL_PIOCHE', array(':partie_id' => $partie_id));
        
        $wagon_pioche = $wagons[rand(0, count($wagons)-1)];

        parent::exec('CHANGE_NOMBRE_WAGON', array(':partie_id' => $partie_id, ':wagon_id' => $wagon_pioche->wagon_id, ':nb' => $wagon_pioche->nombre-1));
        
        return $wagon_pioche;
    }
    
    public static function remettreCartesDefaussees($partie_id, $type, $nb)
    {
        $map = Map::getMap($partie_id);
        $wagon = Wagon::getByType($type, $map->map_id);
        
        parent::exec('REMETTRE_CARTES_DEFAUSSEES', array(':partie_id' => $partie_id, ':nb' => $nb, ':wagon_id' => $wagon->wagon_id));
    }
    
    public static function supprimerPiocheByPartie($partie_id)
    {
        parent::exec('SUPPRIMER_PIOCHE_BY_PARTIE', array(':partie_id' => $partie_id));
    }
    
}
