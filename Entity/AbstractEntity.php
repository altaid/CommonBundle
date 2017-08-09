<?php

namespace Altaid\CommonBundle\Entity;

use Altaid\CommonBundle\Traits\SetPropertiesFromArrayTrait;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements EntityInterface
{
    use SetPropertiesFromArrayTrait;

    /**
     * AbstractEntity constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            $this->fromArray($data);
        }
    }
}