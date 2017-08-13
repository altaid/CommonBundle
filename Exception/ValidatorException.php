<?php

namespace Altaid\CommonBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidatorException
 */
class ValidatorException extends \Exception
{
    /**
     * @var ConstraintViolationListInterface
     */
    private $violations;

    /**
     * ValidatorException constructor.
     * @param string $message
     * @param ConstraintViolationListInterface $violations
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = "", ConstraintViolationListInterface $violations, $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->violations = $violations;
    }

    /**
     * Gets the list of violations
     *
     * @return ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}