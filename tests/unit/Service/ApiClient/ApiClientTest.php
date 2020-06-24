<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Service\ApiClient;

use Codeception\Test\Unit;
use Exception;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClient;
use F1Monkey\EveEsiBundle\Service\ApiClient\RequestOptionsProviderInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use stdClass;

/**
 * Class ApiClientTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Service\ApiClient
 */
class ApiClientTest extends Unit
{
    /**
     * @throws RuntimeException
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanGetPostRequestResponseBody()
    {
        $expected = 'response';
        $body     = $this->makeEmpty(StreamInterface::class, ['getContents' => $expected,]);
        $response = $this->makeEmpty(ResponseInterface::class, ['getBody' => $body]);
        /** @var ClientInterface $guzzle */
        $guzzle = $this->makeEmpty(ClientInterface::class, ['request' => $response]);
        /** @var RequestOptionsProviderInterface $optionsProvider */
        $optionsProvider = $this->makeEmpty(RequestOptionsProviderInterface::class, ['createPostRequestOptions' => []]);
        $client          = new ApiClient($guzzle, $optionsProvider, 'baseUrl');

        $result = $client->post('/', new stdClass());

        static::assertSame($expected, $result);
    }

    /**
     * @throws RuntimeException
     * @throws InvalidUriException
     * @throws Exception
     */
    public function testCanThrowImpossibleExceptionOnPostRequest()
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
        /** @var RequestOptionsProviderInterface $optionsProvider */
        $optionsProvider = $this->makeEmpty(RequestOptionsProviderInterface::class, ['createPostRequestOptions' => []]);
        $client          = new ApiClient($guzzle, $optionsProvider, 'baseUrl');

        $this->expectException(ImpossibleException::class);
        $client->post('/', new stdClass());
    }
}