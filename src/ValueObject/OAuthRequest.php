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
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        $result = [
            RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
        ];

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