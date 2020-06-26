<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

use GuzzleHttp\RequestOptions;
use JMS\Serializer\ArrayTransformerInterface;
use LogicException;

/**
 * Class EsiRequest
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 */
class EsiRequest implements RequestInterface
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
     * @var string|null
     */
    protected ?string $accessToken;

    /**
     * @var object|null
     */
    protected ?object $request;

    /**
     * OAuthRequest constructor.
     *
     * @param ArrayTransformerInterface $arrayTransformer
     * @param string                    $baseUrl
     */
    public function __construct(
        ArrayTransformerInterface $arrayTransformer,
        string $baseUrl
    )
    {
        $this->arrayTransformer = $arrayTransformer;
        $this->baseUrl          = $baseUrl;
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
     * @param string $endpoint
     *
     * @return EsiRequest
     */
    public function setEndpoint(string $endpoint): EsiRequest
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getRequest(): ?object
    {
        return $this->request;
    }

    /**
     * @param object|null $request
     *
     * @return EsiRequest
     */
    public function setRequest(?object $request): EsiRequest
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param string|null $accessToken
     *
     * @return EsiRequest
     */
    public function setAccessToken(?string $accessToken): EsiRequest
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getGetRequestOptions(): array
    {
        $result = [];

        if ($this->accessToken !== null) {
            $result[RequestOptions::HEADERS] = [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
            ];
        }

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
        $result = [];

        if ($this->accessToken !== null) {
            $result[RequestOptions::HEADERS] = [
                'Authorization' => sprintf('Bearer %s', $this->accessToken),
            ];
        }

        if ($this->request !== null) {
            $result[RequestOptions::JSON] = $this->arrayTransformer->toArray($this->request);
        }

        return $result;
    }

    public function __clone()
    {
        $this->endpoint    = null;
        $this->request     = null;
        $this->accessToken = null;
    }
}