<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

use GuzzleHttp\RequestOptions;
use JMS\Serializer\ArrayTransformerInterface;

/**
 * Class OAuthRequest
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 */
class OAuthRequest implements RequestInterface
{
    use RequestTrait;

    /**
     * @var ArrayTransformerInterface
     */
    protected ArrayTransformerInterface $arrayTransformer;

    /**
     * @var string
     */
    protected string $clientId;

    /**
     * @var string
     */
    protected string $clientSecret;

    /**
     * OAuthRequest constructor.
     *
     * @param ArrayTransformerInterface $arrayTransformer
     * @param string                    $baseUrl
     * @param string                    $clientId
     * @param string                    $clientSecret
     * @param string|null               $userAgent
     */
    public function __construct(
        ArrayTransformerInterface $arrayTransformer,
        string $baseUrl,
        string $clientId,
        string $clientSecret,
        string $userAgent = null
    )
    {
        $this->arrayTransformer = $arrayTransformer;
        $this->baseUrl          = $baseUrl;
        $this->clientId         = $clientId;
        $this->clientSecret     = $clientSecret;
        $this->userAgent        = $userAgent;
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        $result = [
            RequestOptions::HEADERS => $this->headers,
            RequestOptions::AUTH    => [$this->clientId, $this->clientSecret],
        ];

        if ($this->userAgent !== null) {
            $result[RequestOptions::HEADERS]['User-Agent'] = $this->userAgent;
        }

        if ($this->query !== null) {
            $result[RequestOptions::QUERY] = $this->arrayTransformer->toArray($this->query);
        }

        if ($this->body !== null) {
            $result[RequestOptions::JSON] = $this->arrayTransformer->toArray($this->body);
        }

        return $result;
    }

    public function __clone()
    {
        $this->endpoint = null;
        $this->query    = null;
        $this->body     = null;
        $this->headers  = [];
    }
}