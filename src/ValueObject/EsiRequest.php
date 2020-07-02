<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

use GuzzleHttp\RequestOptions;
use JMS\Serializer\ArrayTransformerInterface;

/**
 * Class EsiRequest
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 */
class EsiRequest implements RequestInterface
{
    use RequestTrait;

    /**
     * @var ArrayTransformerInterface
     */
    protected ArrayTransformerInterface $arrayTransformer;

    /**
     * OAuthRequest constructor.
     *
     * @param ArrayTransformerInterface $arrayTransformer
     * @param string                    $baseUrl
     * @param string|null               $userAgent
     */
    public function __construct(
        ArrayTransformerInterface $arrayTransformer,
        string $baseUrl,
        string $userAgent = null
    )
    {
        $this->arrayTransformer = $arrayTransformer;
        $this->baseUrl          = $baseUrl;
        $this->userAgent        = $userAgent;
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        $result = [
            RequestOptions::HEADERS => $this->headers,
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