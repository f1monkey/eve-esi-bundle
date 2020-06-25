<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use Symfony\Component\HttpFoundation\Request;
use function Sabre\Uri\resolve as resolve;

/**
 * Class ApiClient
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 *
 * @internal
 */
class ApiClient implements ApiClientInterface
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $httpClient;

    /**
     * @var SerializerInterface
     */
    protected SerializerInterface $serializer;

    /**
     * @var RequestExceptionFactoryInterface
     */
    protected RequestExceptionFactoryInterface $exceptionFactory;

    /**
     * ApiClient constructor.
     *
     * @param ClientInterface                  $httpClient
     * @param SerializerInterface              $serializer
     * @param RequestExceptionFactoryInterface $exceptionFactory
     */
    public function __construct(
        ClientInterface $httpClient,
        SerializerInterface $serializer,
        RequestExceptionFactoryInterface $exceptionFactory
    )
    {
        $this->httpClient = $httpClient;
        $this->serializer = $serializer;
        $this->exceptionFactory = $exceptionFactory;
    }

    /**
     * @param ClientInterface $httpClient
     *
     * @return ApiClient
     */
    public function setHttpClient(ClientInterface $httpClient): ApiClient
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws InvalidUriException
     * @throws ApiClientExceptionInterface
     * @throws RuntimeException
     */
    public function post(RequestInterface $request, string $responseClass): object
    {
        $options = $request->getPostRequestOptions();

        try {
            $response = $this->httpClient->request(
                Request::METHOD_POST,
                $this->createUrl($request->getBaseUrl(), $request->getEndpoint()),
                $options
            );
        } catch (GuzzleException $e) {
            if ($e instanceof RequestException) {
                throw $this->exceptionFactory->createRequestException($e);
            }

            throw new ImpossibleException($e->getMessage(), $e->getCode(), $e);
        }

        // @phpstan-ignore-next-line
        return $this->serializer->deserialize($response->getBody()->getContents(), $responseClass, 'json');
    }

    /**
     * @param string $baseUrl
     * @param string $endPoint
     *
     * @return string
     * @throws InvalidUriException
     */
    protected function createUrl(string $baseUrl, string $endPoint): string
    {
        return resolve($baseUrl, $endPoint);
    }
}