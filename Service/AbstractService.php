<?php

namespace Altaid\CommonBundle\Service;

use Altaid\CommonBundle\Entity\EntityInterface;
use Altaid\CommonBundle\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractService
 */
abstract class AbstractService
{
    protected $validator;

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
}