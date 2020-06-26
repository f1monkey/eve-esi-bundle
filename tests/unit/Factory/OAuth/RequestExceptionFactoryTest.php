<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Factory\OAuth;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Dto\OAuth\Response\ErrorResponse;
use F1monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;
use F1monkey\EveEsiBundle\Factory\OAuth\RequestExceptionFactory;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\ExpectationFailedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;

/**
 * Class RequestExceptionFactoryTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Factory\OAuth
 */
class RequestExceptionFactoryTest extends Unit
{
    /**
     * @throws ExpectationFailedException
     * @throws RuntimeException
     * @throws Exception
     */
    public function testCanCreateRequestException()
    {
        $expected     = new ErrorResponse();
        $expectedCode = 400;

        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class, ['deserialize' => $expected]);

        $response = $this->makeEmpty(
            ResponseInterface::class,
            [
                'getStatusCode' => $expectedCode,
                'getBody'       => $this->makeEmpty(
                    StreamInterface::class,
                    [
                        'getContents' => '',
                    ]
                ),
            ]
        );
        /** @var RequestException $exception */
        $exception = $this->makeEmpty(
            RequestException::class,
            [
                'getResponse' => $response,
            ]
        );

        $factory = new RequestExceptionFactory($serializer);
        $result  = $factory->createRequestException($exception);

        static::assertInstanceOf(OAuthRequestException::class, $result);
        static::assertSame($expected, $result->getErrorResponse());
        static::assertSame($expectedCode, $result->getStatusCode());
    }

    /**
     * @throws ExpectationFailedException
     * @throws RuntimeException
     * @throws Exception
     */
    public function testCanCreateRequestExceptionFromEmptyResponse()
    {
        /** @var SerializerInterface $serializer */
        $serializer = $this->makeEmpty(SerializerInterface::class);
        /** @var RequestException $exception */
        $exception = $this->makeEmpty(
            RequestException::class,
            [
                'getResponse' => null,
            ]
        );

        $factory = new RequestExceptionFactory($serializer);
        $result  = $factory->createRequestException($exception);

        static::assertInstanceOf(OAuthRequestException::class, $result);
        static::assertNull($result->getStatusCode());
    }
}