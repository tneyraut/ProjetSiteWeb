<?php

Wagon::addQuery('GET_MAP_WAGON', 'SELECT wagon_id,type,image,nb_initial FROM wagon WHERE map_id=:map_id');

Wagon::addQuery('GET_BY_TYPE', 'SELECT wagon_id,image,type FROM wagon WHERE map_id=:map_id AND type=:type');