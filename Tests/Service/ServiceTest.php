<?php

namespace Altaid\CommonBundle\Tests\Service;

use Altaid\CommonBundle\Tests\Entity\Entity;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ServiceTest
 * @package Altaid\CommonBundle\Tests\Service
 */
class ServiceTest extends WebTestCase
{
    /**
     * @var Service
     */
    private $service;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $container = self::bootKernel()->getContainer();
        $this->service = new Service($container->get('validator'));
    }

    public function testConstruct()
    {
        self::assertInstanceOf(Service::class, new Service());
    }

    /**
     * @covers \Altaid\CommonBundle\Service\AbstractService::validate()
     * @expectedException \Altaid\CommonBundle\Exception\ValidatorException
     */
    public function testValidationException()
    {
        $entity = new Entity();
        $this->service->validate($entity);
    }

    /**
     * @covers \Altaid\CommonBundle\Service\AbstractService::validate()
     */
    public function testValidate()
    {
        $entity = new Entity(['name' => 'noname']);
        self::assertInstanceOf(Entity::class, $this->service->validate($entity));
    }
}