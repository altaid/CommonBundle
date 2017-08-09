<?php

namespace Altaid\CommonBundle\Traits;

/**
 * Trait SetPropertiesFromArrayTrait
 * @package Altaid\CommonBundle\Traits
 */
trait SetPropertiesFromArrayTrait
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return $this
     */
    public function fromArray(Array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }

        return $this;
    }
}