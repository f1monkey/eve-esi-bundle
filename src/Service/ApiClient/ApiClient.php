<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\ApiClient;

use F1monkey\EveEsiBundle\Event\RequestAfterEvent;
use F1monkey\EveEsiBundle\Event\RequestBeforeEvent;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use F1monkey\EveEsiBundle\Exception\Esi\NotModifiedException;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
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
     * @var EventDispatcherInterface
     */
    protected EventDispatcherInterface $eventDispatcher;

    /**
     * @var RequestExceptionFactoryInterface
     */
    protected RequestExceptionFactoryInterface $exceptionFactory;

    /**
     * ApiClient constructor.
     *
     * @param ClientInterface                  $httpClient
     * @param SerializerInterface              $serializer
     * @param EventDispatcherInterface         $eventDispatcher
     * @param RequestExceptionFactoryInterface $exceptionFactory
     */
    public function __construct(
        ClientInterface $httpClient,
        SerializerInterface $serializer,
        EventDispatcherInterface $eventDispatcher,
        RequestExceptionFactoryInterface $exceptionFactory
    )
    {
        $this->httpClient       = $httpClient;
        $this->serializer       = $serializer;
        $this->eventDispatcher  = $eventDispatcher;
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
     * @throws NotModifiedException
     * @throws RuntimeException
     * @throws InvalidUriException
     */
    public function post(RequestInterface $request, string $responseClass): object
    {
        $options = $request->getRequestOptions();

        return $this->makeRequest($request, $options, $responseClass, Request::METHOD_POST);
    }

    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws ApiClientExceptionInterface
     * @throws NotModifiedException
     * @throws RuntimeException
     * @throws InvalidUriException
     */
    public function get(RequestInterface $request, string $responseClass): object
    {
        $options = $request->getRequestOptions();

        return $this->makeRequest($request, $options, $responseClass, Request::METHOD_GET);
    }

    /**
     * @param RequestInterface     $request
     * @param array<string, mixed> $options
     * @param string               $responseClass
     * @param string               $method
     *
     * @return object
     * @throws NotModifiedException
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
        $event = new RequestBeforeEvent($request, $options);
        $this->eventDispatcher->dispatch($event);

        try {
            $response = $this->httpClient->request(
                $method,
                $this->createUrl($request->getBaseUrl(), $request->getEndpoint()),
                $event->getOptions()
            );
        } catch (GuzzleException $e) {
            if ($e instanceof RequestException) {
                throw $this->exceptionFactory->createRequestException($e);
            }

            throw new ImpossibleException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() === Response::HTTP_NOT_MODIFIED) {
            throw new NotModifiedException('Not modified');
        }

        // @phpstan-ignore-next-line
        $result = $this->serializer->deserialize($response->getBody()->getContents(), $responseClass, 'json');

        $event = new RequestAfterEvent($result, $response);
        $this->eventDispatcher->dispatch($event);

        return $event->getResponseObject();
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