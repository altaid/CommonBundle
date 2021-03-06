<?php

namespace Altaid\CommonBundle\Tests\Entity;

use Altaid\CommonBundle\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Entity
 * @package Altaid\CommonBundle\Tests\Entity
 *
 * @ORM\Entity(repositoryClass="Altaid\CommonBundle\Tests\Repository\Repository")
 */
class Entity extends AbstractEntity
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Entity
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}