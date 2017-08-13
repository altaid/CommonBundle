<?php

namespace Altaid\CommonBundle\Tests\Service;

use Altaid\CommonBundle\Tests\Entity\Entity;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     * @var ContainerInterface
     */
    private $container;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $this->container = self::bootKernel()->getContainer();
        $this->service = new Service($this->container->get('validator'));
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