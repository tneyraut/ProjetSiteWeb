<?php

class Wagon extends Model
{
    public static function getWagonsByMap($map_id)
    {
        $wagons = parent::exec('GET_MAP_WAGON', array(':map_id' => $map_id));
        return $wagons;
    }
    
    public static function getByType($type, $map_id)
    {
        $wagon = parent::exec('GET_BY_TYPE', array(':type' => $type, ':map_id' => $map_id));
        if(count($wagon) > 0)
            return $wagon[0];
        
        return NULL;
    }
}