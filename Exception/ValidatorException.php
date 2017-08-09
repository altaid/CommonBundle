<?php

namespace Altaid\CommonBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidatorException
 */
class ValidatorException extends \Exception
{
    public function __construct($message = "", ConstraintViolationListInterface $violations, $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}