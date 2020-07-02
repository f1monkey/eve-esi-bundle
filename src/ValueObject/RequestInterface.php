<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\ValueObject;

/**
 * Interface RequestInterface
 *
 * @package F1monkey\EveEsiBundle\ValueObject
 *
 * @internal
 */
interface RequestInterface
{
    /**
     * @return string
     */
    public function getBaseUrl(): string;

    /**
     * @return string
     */
    public function getEndpoint(): string;

    /**
     * @param string $endpoint
     *
     * @return $this
     */
    public function setEndpoint(string $endpoint);

    /**
     * @return object|null
     */
    public function getQuery(): ?object;

    /**
     * @param object|null $query
     *
     * @return $this
     */
    public function setQuery(?object $query);

    /**
     * @return object|null
     */
    public function getBody(): ?object;

    /**
     * @param object|null $body
     *
     * @return $this
     */
    public function setBody(?object $body);

    /**
     * @return array<string, string>
     */
    public function getHeaders(): array;

    /**
     * @param string $header
     * @param string $value
     *
     * @return $this
     */
    public function setHeader(string $header, string $value);

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array;
}