<?php

abstract class Model extends Object// implements JsonSerializable
{

    protected $props;
    protected static $queries = array();

    public function __construct($props = array())
    {
        $this->props = $props;
    }

    public function __get($prop)
    {
        return $this->props[$prop];
    }

    public function __set($prop, $val)
    {
        $this->props[$prop] = $val;
    }
    
    public function __isset($prop) {
        return isset($this->props[$prop]);
    }
    
    public function jsonSerialize() {
        return $this->props;
    }
    
    public function tableName()
    {
        if(property_exists($this, 'tableName'))
            return $this->tableName;
        else
            return strtolower(get_class($this));
    }

    protected static function db()
    {
        return DatabasePDO::singleton();
    }

    protected static function query($sql)
    {
        $st = static::db()->prepare($sql) or die("sql query error ! request : " . $sql);
        $st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
        
        return $st;
    }

    public static function addQuery($id, $query)
    {
        static::$queries[$id] = $query;
    }

    public static function exec($id, $params)
    {
        $preparedQuery = static::query(static::$queries[$id]);
        
        foreach($params as $key => $value)
        {
            if(is_int($value))
                $preparedQuery->bindValue($key, (int) $value, PDO::PARAM_INT);
            else
                $preparedQuery->bindValue($key, $value);
        }
        $preparedQuery->execute();

        //print_r($preparedQuery->errorInfo());
        
        return $preparedQuery->fetchAll();
    }

}