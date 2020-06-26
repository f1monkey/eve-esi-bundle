<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Interface ValidationEXceptionInterface
 *
 * @package F1monkey\EveEsiBundle\Exception
 */
interface ValidationExceptionInterface extends EveEsiBundleExceptionInterface
{
    /**
     * @return ConstraintViolationListInterface<ConstraintViolationInterface>
     */
    public function getViolations(): ConstraintViolationListInterface;
}