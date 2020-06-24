<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Trait ValidationExceptionTrait
 *
 * @package F1Monkey\EveEsiBundle\Exception
 */
trait ValidationExceptionTrait
{
    /**
     * @var ConstraintViolationListInterface
     */
    protected ConstraintViolationListInterface $violations;

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}