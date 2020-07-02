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

    /**
     * @var int
     */
    protected int $statusCode = 200;

    /**
     * @var array<string, string>
     */
    protected array $responseHeaders = [];

    /**
     * @var string|null
     */
    protected ?string $lastRequestUrl = null;

    /**
     * @var array|null
     */
    protected ?array $lastRequestOptions = null;

    public function request($method, $uri, array $options = [])
    {
        $body = Stub::makeEmpty(
            StreamInterface::class,
            [
                'getContents' => $this->response,
            ]
        );

        $this->lastRequestUrl     = $uri;
        $this->lastRequestOptions = $options;

        return Stub::makeEmpty(
            ResponseInterface::class,
            [
                'getBody'       => $body,
                'getHeaders'    => $this->responseHeaders,
                'getStatusCode' => $this->statusCode,
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

    /**
     * @return string|null
     */
    public function getLastRequestUrl(): ?string
    {
        return $this->lastRequestUrl;
    }

    /**
     * @return array|null
     */
    public function getLastRequestOptions(): ?array
    {
        return $this->lastRequestOptions;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return HttpClientMock
     */
    public function setStatusCode(int $statusCode): HttpClientMock
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return array
     */
    public function getResponseHeaders(): array
    {
        return $this->responseHeaders;
    }

    /**
     * @param array $responseHeaders
     *
     * @return HttpClientMock
     */
    public function setResponseHeaders(array $responseHeaders): HttpClientMock
    {
        $this->responseHeaders = $responseHeaders;

        return $this;
    }
}