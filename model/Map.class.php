<?php

class Map extends Model
{
    
    public static function getMap($partie_id) 
    {
        $map = parent::exec('GET_MAP', array(':partie_id' => $partie_id));
        if(count($map) > 0)
            return $map[0];
    }
    
    public static function getMapIDByName($mapName)
    {
        $map = parent::exec('GET_MAP_ID_BY_NAME', array(':nom' => $mapName));
        if (count($map) > 0) {
            return $map[0];
        }
    }
    
}
