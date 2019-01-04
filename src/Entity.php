<?php

namespace StirlingMySQL;

use Stirling\Database\IEntity;

abstract class Entity implements IEntity
{
    private $properties;

    /**
     * Entity constructor.
     * @param $properties
     */
    public function __construct($properties)
    {
        $this->properties = $properties;
    }


    public function __get($name)
    {
        if (key_exists($name, $this->properties)) {
            return $this->properties[$name];
        } else {
            return null;
        }
    }

    function __set($name, $value)
    {
        if (key_exists($name, $this->properties)) {
            $this->properties[$name] = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getProperties()
    {
        return $this->properties;
    }

    public function __isset($key)
    {
        if (isset($this->getProperties()[$key])) {
            return (false === empty($this->getProperties()[$key]));
        } else {
            return null;
        }
    }
}
