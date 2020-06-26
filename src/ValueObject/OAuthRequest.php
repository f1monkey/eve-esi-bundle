<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

use GuzzleHttp\RequestOptions;
use JMS\Serializer\ArrayTransformerInterface;
use LogicException;

/**
 * Class OAuthRequest
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 */
class OAuthRequest implements RequestInterface
{
    /**
     * @var ArrayTransformerInterface
     */
    protected ArrayTransformerInterface $arrayTransformer;

    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var string
     */
    protected ?string $endpoint;

    /**
     * @var string
     */
    protected string $clientId;

    /**
     * @var string
     */
    protected string $clientSecret;

    /**
     * @var object|null
     */
    protected ?object $request;

    /**
     * OAuthRequest constructor.
     *
     * @param ArrayTransformerInterface $arrayTransformer
     * @param string                    $baseUrl
     * @param string                    $clientId
     * @param string                    $clientSecret
     */
    public function __construct(
        ArrayTransformerInterface $arrayTransformer,
        string $baseUrl,
        string $clientId,
        string $clientSecret
    )
    {
        $this->arrayTransformer = $arrayTransformer;
        $this->baseUrl          = $baseUrl;
        $this->clientId         = $clientId;
        $this->clientSecret     = $clientSecret;
    }

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        if ($this->endpoint === null) {
            throw new LogicException('Request endpoint must be provided');
        }

        return $this->endpoint;
    }

    /**
     * @return object|null
     */
    public function getRequest(): ?object
    {
        return $this->request;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGetRequestOptions(): array
    {
        $result = [
            RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
        ];

        if ($this->request !== null) {
            $result[RequestOptions::QUERY] = $this->arrayTransformer->toArray($this->request);
        }

        return $result;
    }

    /**
     * @return array<string, mixed>
     */
    public function getPostRequestOptions(): array
    {
        $result = [
            RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
        ];

        if ($this->request !== null) {
            $result[RequestOptions::JSON] = $this->arrayTransformer->toArray($this->request);
        }

        return $result;
    }

    /**
     * @param string $endpoint
     *
     * @return OAuthRequest
     */
    public function setEndpoint(string $endpoint): OAuthRequest
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @param object|null $request
     *
     * @return OAuthRequest
     */
    public function setRequest(?object $request): OAuthRequest
    {
        $this->request = $request;

        return $this;
    }

    public function __clone()
    {
        $this->endpoint = null;
        $this->request  = null;
    }
}