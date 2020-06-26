<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Trait ValidationExceptionTrait
 *
 * @package F1monkey\EveEsiBundle\Exception
 */
trait ValidationExceptionTrait
{
    /**
     * @var ConstraintViolationListInterface<ConstraintViolationInterface>
     */
    protected ConstraintViolationListInterface $violations;

    /**
     * @return ConstraintViolationListInterface<ConstraintViolationInterface>
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}