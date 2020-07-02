<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

use LogicException;

/**
 * Class AbstractRequest
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 */
trait RequestTrait
{
    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @var string
     */
    protected ?string $endpoint;

    /**
     * @var object|null
     */
    protected ?object $query;

    /**
     * @var object|null
     */
    protected ?object $body;

    /**
     * @var array<string, string>
     */
    protected array $headers = [];

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
     * @return $this
     */
    public function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getQuery(): ?object
    {
        return $this->query;
    }

    /**
     * @param object|null $query
     *
     * @return $this
     */
    public function setQuery(?object $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @return object|null
     */
    public function getBody(): ?object
    {
        return $this->body;
    }

    /**
     * @param object|null $body
     *
     * @return $this
     */
    public function setBody(?object $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $header
     * @param string $value
     *
     * @return $this
     */
    public function setHeader(string $header, string $value)
    {
        $this->headers[$header] = $value;

        return $this;
    }
}