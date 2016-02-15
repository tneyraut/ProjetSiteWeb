<?php

class PiocheVisible extends Model
{
    
    public static function addWagon($partie_id, $wagon_id)
    {
        parent::exec('ADD_WAGON_VISIBLE', array(':partie_id' => $partie_id, ':wagon_id' => $wagon_id));
    }
    
    public static function getCartes($partie_id)
    {
        return parent::exec('GET_CARTES', array(':partie_id' => $partie_id));
    }
    
    public static function piocherType($partie_id, $type)
    {
        $map = Map::getMap($partie_id);

        $wagon = Wagon::getByType($type, $map->map_id);
        
        $wagons = parent::exec('IS_PRESENT', array(':partie_id' => $partie_id, ':wagon_id' => $wagon->wagon_id));
        if(count($wagons) > 0)
        {
            parent::exec('REMOVE_BY_TYPE', array(':partie_id' => $partie_id, ':wagon_id' => $wagon->wagon_id));

            $nouvelleCarte = Pioche::piocher($partie_id);
            PiocheVisible::addWagon($partie_id, $nouvelleCarte->wagon_id);

            return $wagon;
        }
        
        return NULL;
    }
    
    public static function supprimerPiocheVisibleByPartie($partie_id)
    {
        parent::exec('SUPPRIMER_PIOCHE_VISIBLE_BY_PARTIE', array(':partie_id' => $partie_id));
    }
    
}
