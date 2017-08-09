<?php

namespace Altaid\CommonBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    /**
     * @var int
     */
    protected $lifetime;

    /**
     * Gets cached query
     *
     * @param Query $query
     * @param string|null $resultCacheId
     * @param int|null $lifetime
     * @return Query
     */
    public function getCachedQuery(Query &$query, string $resultCacheId = null, int $lifetime = null): Query
    {
        return $query
            ->useQueryCache(true)
            ->useResultCache(true, $lifetime ?? $this->lifetime, $resultCacheId);
    }

    /**
     * Gets cached query from dql
     *
     * @param string $dql
     * @param string|null $resultCacheId
     * @param int|null $lifetime
     * @return Query
     */
    public function getCachedQueryFromDql(string $dql, string $resultCacheId = null, int $lifetime = null): Query
    {
        $query = $this->_em->createQuery($dql);

        return $this->getCachedQuery($query, $resultCacheId, $lifetime);
    }

    /**
     * Removes query results from cache by result cache id
     *
     * @param string $resultCacheId
     * @return bool
     */
    public function flushResultCache(string $resultCacheId): bool
    {
        $cacheDriver = $this->_em->getConfiguration()->getResultCacheImpl();

        return $cacheDriver->delete($resultCacheId);
    }

    /**
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * @param int $lifetime
     * @return AbstractRepository|$this
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;

        return $this;
    }
}