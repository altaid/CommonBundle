<?php

namespace Altaid\CommonBundle\Tests\Exception;

use Altaid\CommonBundle\Exception\ValidatorException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class ExceptionTest
 * @package Altaid\CommonBundle\Tests\Exception
 */
class ExceptionTest extends WebTestCase
{
    public function testConstruct()
    {
        $errorMessage = 'errorValue';
        $violations = [
            new ConstraintViolation($errorMessage, $errorMessage, [], 'name', 'name', 'some invalid value')
        ];
        $violationList = new ConstraintViolationList($violations);
        $exception = new ValidatorException('some error', $violationList, 400);
        self::assertInstanceOf(ConstraintViolationList::class, $exception->getViolations());
        self::assertEquals($errorMessage, $exception->getViolations()[0]->getMessage());
    }
}