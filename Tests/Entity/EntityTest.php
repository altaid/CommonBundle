<?php

namespace Altaid\CommonBundle\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class EntityTest
 * @package Altaid\CommonBundle\Tests\Entity
 */
class EntityTest extends WebTestCase
{
    /**
     * @var Entity
     */
    private $entity;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->entity = new Entity(['name' => 'Vasia']);
    }

    /**
     * Tests constructor
     */
    public function testConstruct()
    {
        self::assertInstanceOf(Entity::class, new Entity());
    }

    /**
     * @covers \Altaid\CommonBundle\Entity\AbstractEntity::fromArray()
     */
    public function testFromArray()
    {
        $name = 'noname';
        $this->entity->fromArray(['name' => $name]);
        self::assertEquals($name, $this->entity->getName());
    }
}