<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\ApiClient;

use F1monkey\EveEsiBundle\Exception\ValidationExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ValidationExceptionTrait;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * Class RequestValidationException
 *
 * @package F1monkey\EveEsiBundle\Exception\ApiClient
 */
class RequestValidationException extends RuntimeException implements
    ApiClientExceptionInterface,
    ValidationExceptionInterface
{
    use ValidationExceptionTrait;

    /**
     * RequestValidationException constructor.
     *
     * @param ConstraintViolationListInterface<ConstraintViolationInterface> $violations
     * @param string                                                         $message
     * @param int                                                            $code
     * @param Throwable|null                                                 $previous
     */
    public function __construct(
        ConstraintViolationListInterface $violations,
        $message = '',
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->violations = $violations;
        parent::__construct($message, $code, $previous);
    }
}