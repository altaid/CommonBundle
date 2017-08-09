<?php

namespace Altaid\CommonBundle\Tests\Repository;

use Altaid\CommonBundle\Repository\AbstractRepository;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RepositoryTest
 */
class RepositoryTest extends WebTestCase
{
    /**
     * @var \Altaid\CommonBundle\Tests\Repository\Repository
     */
    private $repository;

    /**
     * @var \Doctrine\ORM\Query
     */
    private $query;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        parent::setUp();
        $container = self::bootKernel()->getContainer();
        $this->em = $container->get('doctrine')->getManager();
        $this->query = new Query($this->em);
        $class = $this->getMockBuilder('Doctrine\ORM\Mapping\ClassMetadata')
            ->disableOriginalConstructor()
            ->getMock();
        $this->repository = new Repository($this->em, $class);
    }

    /**
     * @covers \Altaid\CommonBundle\Repository\AbstractRepository::getCachedQuery()
     * @covers \Altaid\CommonBundle\Repository\AbstractRepository::flushResultCache()
     */
    public function testGetCachedQueryAndFlush()
    {
        $cacheId = 'cacheKey';
        $lifetime = 3600;
        $result = $this->repository->getCachedQuery($this->query, $cacheId, $lifetime);

        self::assertEquals($this->query, $result);
        self::assertEquals($lifetime, $result->getQueryCacheProfile()->getLifetime());
        self::assertEquals($cacheId, $result->getQueryCacheProfile()->getCacheKey());

        self::assertTrue($this->repository->flushResultCache($cacheId));
    }

    /**
     * @covers \Altaid\CommonBundle\Repository\AbstractRepository::getCachedQueryFromDql()
     */
    public function testGetCachedQueryFromDql()
    {
        self::assertInstanceOf(Query::class, $this->repository->getCachedQueryFromDql('some dql'));
    }

    /**
     * @covers \Altaid\CommonBundle\Repository\AbstractRepository::setLifetime()
     * @covers \Altaid\CommonBundle\Repository\AbstractRepository::getLifetime()
     */
    public function testSetGetLifetime()
    {
        $lifetime = 3600;
        $result = $this->repository->setLifetime($lifetime);

        self::assertInstanceOf(Repository::class, $result);
        self::assertInternalType('int', $result->getLifetime());
        self::assertEquals($lifetime, $result->getLifetime());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}