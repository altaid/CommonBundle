<?php

namespace Altaid\CommonBundle\Entity;

/**
 * Interface EntityInterface
 * @package Altaid\CommonBundle\Entity
 */
interface EntityInterface
{
    /**
     * Fills attributes from array
     *
     * @param array $data
     * @return SetPropertiesFromArrayTrait|$this
     */
    public function fromArray(array $data): self;
}