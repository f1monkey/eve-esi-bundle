<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\OAuth;

use F1monkey\EveEsiBundle\Dto\OAuth\Response\ErrorResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;
use F1monkey\EveEsiBundle\Service\ApiClient\RequestExceptionFactoryInterface;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use RuntimeException;

/**
 * Class RequestExceptionFactory
 *
 * @package F1monkey\EveEsiBundle\Factory\OAuth
 */
class RequestExceptionFactory implements RequestExceptionFactoryInterface
{
    /**
     * @var SerializerInterface
     */
    protected SerializerInterface $serializer;

    /**
     * RequestExceptionFactory constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param RequestException $exception
     *
     * @return ApiClientExceptionInterface
     * @throws RuntimeException
     */
    public function createRequestException(RequestException $exception): ApiClientExceptionInterface
    {
        $response = $exception->getResponse();
        if ($response !== null) {
            /** @var ErrorResponse $errorResponse */
            $errorResponse = $this->serializer->deserialize(
                $response->getBody()->getContents(),
                ErrorResponse::class,
                'json'
            );
            $statusCode    = $response->getStatusCode();
        } else {
            $errorResponse = new ErrorResponse();
            $statusCode    = null;
        }

        return new OAuthRequestException($errorResponse, $statusCode, $exception->getMessage());
    }
}