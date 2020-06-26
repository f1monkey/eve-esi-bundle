<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\Esi;

use F1Monkey\EveEsiBundle\Dto\Esi\Response\ErrorResponse;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\Esi\EsiRequestException;
use F1Monkey\EveEsiBundle\Service\ApiClient\RequestExceptionFactoryInterface;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;

/**
 * Class RequestExceptionFactory
 *
 * @package F1Monkey\EveEsiBundle\Factory\Esi
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
     * @throws \RuntimeException
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

        return new EsiRequestException($errorResponse, $statusCode);
    }
}