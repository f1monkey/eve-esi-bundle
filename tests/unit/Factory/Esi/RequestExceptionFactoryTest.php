<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Factory\Esi;

use Codeception\Test\Unit;
use F1Monkey\EveEsiBundle\Dto\Esi\Response\ErrorResponse;
use F1Monkey\EveEsiBundle\Exception\Esi\EsiRequestException;
use F1Monkey\EveEsiBundle\Factory\Esi\RequestExceptionFactory;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\ExpectationFailedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class RequestExceptionFactoryTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Factory\Esi
 */
class RequestExceptionFactoryTest extends Unit
{
    /**
     * @throws ExpectationFailedException
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

        static::assertInstanceOf(EsiRequestException::class, $result);
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

        static::assertInstanceOf(EsiRequestException::class, $result);
        static::assertNull($result->getStatusCode());
    }
}