<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\ApiClient;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use Symfony\Component\HttpFoundation\Request;
use function Sabre\Uri\resolve as resolveUrl;

/**
 * Class ApiClient
 *
 * @package F1monkey\EveEsiBundle\Service\ApiClient
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
        $this->httpClient       = $httpClient;
        $this->serializer       = $serializer;
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
     * @throws ApiClientExceptionInterface
     * @throws RuntimeException
     * @throws InvalidUriException
     */
    public function post(RequestInterface $request, string $responseClass): object
    {
        $options = $request->getPostRequestOptions();

        return $this->makeRequest($request, $options, $responseClass, Request::METHOD_POST);
    }

    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws ApiClientExceptionInterface
     * @throws RuntimeException
     * @throws InvalidUriException
     */
    public function get(RequestInterface $request, string $responseClass): object
    {
        $options = $request->getGetRequestOptions();

        return $this->makeRequest($request, $options, $responseClass, Request::METHOD_GET);
    }

    /**
     * @param RequestInterface     $request
     * @param array<string, mixed> $options
     * @param string               $responseClass
     * @param string               $method
     *
     * @return object
     * @throws ApiClientExceptionInterface
     * @throws InvalidUriException
     * @throws RuntimeException
     */
    protected function makeRequest(
        RequestInterface $request,
        array $options,
        string $responseClass,
        string $method
    ): object
    {
        try {
            $response = $this->httpClient->request(
                $method,
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
        return resolveUrl($baseUrl, $endPoint);
    }
}