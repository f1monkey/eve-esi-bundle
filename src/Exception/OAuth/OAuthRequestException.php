<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception\OAuth;

use F1Monkey\EveEsiBundle\Dto\OAuth\Response\ErrorResponse;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

/**
 * Class OAuthRequestException
 *
 * @package F1Monkey\EveEsiBundle\Exception\OAuth
 */
class OAuthRequestException extends RuntimeException implements OAuthExceptionInterface, ApiClientExceptionInterface, HttpExceptionInterface
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
    public function getHeaders()
    {
        return [];
    }
}