<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\ValueObject;

/**
 * Interface RequestInterface
 *
 * @package F1Monkey\EveEsiBundle\ValueObject
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
     * @return object
     */
    public function getRequest(): object;

    /**
     * @return array<string, mixed>
     */
    public function getPostRequestOptions(): array;

    /**
     * @param string $endpoint
     *
     * @return RequestInterface
     */
    public function setEndpoint(string $endpoint): RequestInterface;

    /**
     * @param object $request
     *
     * @return RequestInterface
     */
    public function setRequest(object $request): RequestInterface;
}