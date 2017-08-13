<?php

namespace Altaid\CommonBundle\Service;

use Altaid\CommonBundle\Entity\EntityInterface;
use Altaid\CommonBundle\Exception\ValidatorException;
use Altaid\CommonBundle\Repository\AbstractRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractService
 */
abstract class AbstractService
{
    /**
     * @var null|ValidatorInterface
     */
    protected $validator;

    /**
     * @var AbstractRepository
     */
    protected $repository;

    /**
     * AbstractService constructor.
     * @param ValidatorInterface|null $validator
     */
    public function __construct(ValidatorInterface $validator = null)
    {
        $this->validator = $validator;
    }

    /**
     * Validates an entity
     *
     * @param $entity
     * @param array|null $groups
     * @return mixed
     * @throws ValidatorException
     */
    public function validate(EntityInterface $entity, array $groups = null)
    {
        if ($this->validator) {
            $violations = $this->validator->validate($entity, null, $groups);

            if ($violations->count()) {
                throw new ValidatorException("error.validator.validation_error", $violations, 400);
            }
        }

        return $entity;
    }

    /**
     * Paginates a query
     *
     * @codeCoverageIgnore
     * @param Query $query
     * @param int $page
     * @param int $limit
     * @param bool $fetchJoinCollection
     * @return array
     */
    public function paginate(Query $query, int $page = 1, int $limit = 10, $fetchJoinCollection = true): array
    {
        $paginator = new Paginator($query, $fetchJoinCollection);
        $totalItems = $paginator->count();
        $pagesCount = ceil($totalItems / $limit);
        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))// offset
            ->setMaxResults($limit); // limit

        return [
            'meta' => [
                'page' => $page,
                'total' => $totalItems,
                'pages' => $pagesCount,
                'limit' => $limit,
            ],
            'data' => iterator_to_array($paginator)
        ];
    }

    /**
     * Sets repository
     *
     * @param AbstractRepository $repository
     * @return AbstractService|$this
     */
    public function setRepository(AbstractRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }
}