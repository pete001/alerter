<?php namespace Pete001\Alerter\Domain\Entity;

/**
 * Core abstract super class that all entities extend
 *
 * @author Pete Cheyne <pete.cheyne@gmail.com>
 */
abstract class AbstractEntity
{
    /**
     * All entities have a primary key
     *
     * @var Integer
     */
    protected $id;

    /**
     * Auto set properties
     *
     * @param Array $properties Array of properties to set
     */
    public function __construct(Array $properties = [])
    {
        if ( ! empty($properties)) {
            $this->hydrate($properties);
        }
    }

    /**
     * Hydrate the entity object
     *
     * @param  Array  $properties The key value array of new properties to set
     * @return Object             The updated entity object
     */
    public function hydrate(Array $properties)
    {
        foreach ($this as $property => $value) {
            if (array_key_exists($property, $properties) && $this->$property !== $properties[$property]) {
                $this->__set($property, $properties[$property]);
            }
        }

        return $this;
    }

    /**
     * Magic method to dynamically get entity object properties
     *
     * @param  String          $key The requested property
     * @throws \ErrorException      When the key doesnt exist
     * @return Mixed                The key value
     */
    public function __get($key)
    {
        if (isset($this, $key)) {
            return $this->$key;
        } else {
            throw new \ErrorException("Property {$key} does not exist in class");
        }
    }

    /**
     * Magic method to dynamically set entity object properties
     *
     * @param  String          $key   The property
     * @param  String          $value The intended value
     * @throws \ErrorException        When the key doesnt exist
     * @return Object                 The entity object
     */
    public function __set($key, $value)
    {
        if (isset($this, $key)) {
            $this->$key = $value;
            return $this;
        } else {
            throw new \ErrorException("Property {$key} does not exist in class");
        }
    }

    /**
     * Magic method to determine whether the propery exists
     *
     * @param  String  $key The requested property
     * @return Boolean
     */
    public function __isset($key)
    {
        return property_exists($this, $key);
    }
}
