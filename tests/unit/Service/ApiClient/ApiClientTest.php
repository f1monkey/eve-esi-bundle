<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Service\ApiClient;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use F1monkey\EveEsiBundle\Exception\Esi\NotModifiedException;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClient;
use F1monkey\EveEsiBundle\Service\ApiClient\RequestExceptionFactoryInterface;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use stdClass;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Class ApiClientTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Service\ApiClient
 */
class ApiClientTest extends Unit
{
    /**
     * @throws RuntimeException
     * @throws ApiClientExceptionInterface
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanPerformPostRequest()
    {
        $expected = new stdClass();

        $contents = 'contents';
        $body     = $this->makeEmpty(StreamInterface::class, ['getContents' => $contents]);
        $response = $this->makeEmpty(ResponseInterface::class, ['getBody' => $body]);
        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(ClientInterface::class, ['request' => $response]);
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class, ['deserialize' => $expected]);
        /** @var RequestExceptionFactoryInterface $exceptionFactory */
        $exceptionFactory = $this->makeEmpty(RequestExceptionFactoryInterface::class);
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->makeEmpty(EventDispatcherInterface::class);
        $client     = new ApiClient($guzzle, $serializer, $dispatcher, $exceptionFactory);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class);
        $result  = $client->post($request, stdClass::class);

        static::assertSame($expected, $result);
    }

    /**
     * @throws RuntimeException
     * @throws ApiClientExceptionInterface
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanPerformGetRequest()
    {
        $expected = new stdClass();

        $contents = 'contents';
        $body     = $this->makeEmpty(StreamInterface::class, ['getContents' => $contents]);
        $response = $this->makeEmpty(ResponseInterface::class, ['getBody' => $body]);
        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(ClientInterface::class, ['request' => $response]);
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class, ['deserialize' => $expected]);
        /** @var RequestExceptionFactoryInterface $exceptionFactory */
        $exceptionFactory = $this->makeEmpty(RequestExceptionFactoryInterface::class);
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->makeEmpty(EventDispatcherInterface::class);
        $client     = new ApiClient($guzzle, $serializer, $dispatcher, $exceptionFactory);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class);
        $result  = $client->get($request, stdClass::class);

        static::assertSame($expected, $result);
    }

    /**
     * @throws ApiClientExceptionInterface
     * @throws RuntimeException
     * @throws InvalidUriException
     * @throws Exception
     */
    public function canThrowRequestExceptionOnRequestError()
    {
        $expected = new class extends RuntimeException implements ApiClientExceptionInterface {
        };

        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(
            ClientInterface::class,
            [
                'request' => function () {
                    /** @var RequestException $exception */
                    $exception = $this->makeEmpty(RequestException::class);
                    throw $exception;
                },
            ]
        );
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class, ['deserialize' => $expected]);
        /** @var RequestExceptionFactoryInterface $exceptionFactory */
        $exceptionFactory = $this->makeEmpty(
            RequestExceptionFactoryInterface::class,
            ['createRequestException' => $expected]
        );
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->makeEmpty(EventDispatcherInterface::class);
        $client     = new ApiClient($guzzle, $serializer, $dispatcher, $exceptionFactory);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class);

        $this->expectException(ApiClientExceptionInterface::class);
        $client->post($request, stdClass::class);
    }

    /**
     * @throws RuntimeException
     * @throws ApiClientExceptionInterface
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanThrowNotModifiedException()
    {
        $body     = $this->makeEmpty(StreamInterface::class, ['getContents' => '']);
        $response = $this->makeEmpty(ResponseInterface::class, ['getBody' => $body, 'getStatusCode' => Response::HTTP_NOT_MODIFIED]);
        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(ClientInterface::class, ['request' => $response]);
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class);
        /** @var RequestExceptionFactoryInterface $exceptionFactory */
        $exceptionFactory = $this->makeEmpty(RequestExceptionFactoryInterface::class);
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->makeEmpty(EventDispatcherInterface::class);
        $client     = new ApiClient($guzzle, $serializer, $dispatcher, $exceptionFactory);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class);

        $this->expectException(NotModifiedException::class);
        $client->post($request, stdClass::class);
    }

    /**
     * @throws RuntimeException
     * @throws ApiClientExceptionInterface
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanThrowImpossibleException()
    {
        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(
            ClientInterface::class,
            [
                'request' => function () {
                    throw new class extends Exception implements GuzzleException {
                    };
                },
            ]
        );
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class);
        /** @var RequestExceptionFactoryInterface $exceptionFactory */
        $exceptionFactory = $this->makeEmpty(RequestExceptionFactoryInterface::class);
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->makeEmpty(EventDispatcherInterface::class);
        $client     = new ApiClient($guzzle, $serializer, $dispatcher, $exceptionFactory);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class);

        $this->expectException(ImpossibleException::class);
        $client->post($request, stdClass::class);
    }
}