<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\Esi;

use F1monkey\EveEsiBundle\Dto\Esi\Response\ErrorResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

/**
 * Class EsiRequestException
 *
 * @package F1monkey\EveEsiBundle\Exception\Esi
 */
class EsiRequestException extends RuntimeException implements EsiExceptionInterface, ApiClientExceptionInterface, HttpExceptionInterface
{
    /**
     * @var ErrorResponse
     */
    protected ErrorResponse $errorResponse;

    /**
     * @var int
     */
    protected ?int $statusCode;

    /**
     * OAuthRequestException constructor.
     *
     * @param ErrorResponse $errorResponse
     * @param int $statusCode
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        ErrorResponse $errorResponse,
        ?int $statusCode,
        $message = '',
        $code = 0,
        Throwable $previous = null
    )
    {
        $this->errorResponse = $errorResponse;
        $this->statusCode    = $statusCode;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return ErrorResponse
     */
    public function getErrorResponse(): ErrorResponse
    {
        return $this->errorResponse;
    }

    /**
     * @return int|null
     */
    public function getStatusCode(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return [];
    }
}