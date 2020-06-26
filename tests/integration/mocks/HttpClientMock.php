<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\mocks;

use Codeception\Stub;
use GuzzleHttp\ClientInterface;
use LogicException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Class HttpClientMock
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\mocks
 */
class HttpClientMock implements ClientInterface
{
    /**
     * @var string|null
     */
    protected ?string $response;

    public function request($method, $uri, array $options = [])
    {
        $body = Stub::makeEmpty(
            StreamInterface::class,
            [
                'getContents' => $this->response,
            ]
        );

        return Stub::makeEmpty(
            ResponseInterface::class,
            [
                'getBody' => $body,
            ]
        );
    }

    public function send(RequestInterface $request, array $options = [])
    {
        throw new LogicException('Not implemented');
    }

    public function sendAsync(RequestInterface $request, array $options = [])
    {
        throw new LogicException('Not implemented');
    }

    public function requestAsync($method, $uri, array $options = [])
    {
        throw new LogicException('Not implemented');
    }

    public function getConfig($option = null)
    {
        throw new LogicException('Not implemented');
    }

    /**
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }
}