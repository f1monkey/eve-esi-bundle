<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\Esi;

use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class AbstractEsiRequestFactory
 *
 * @package F1monkey\EveEsiBundle\Factory\Esi
 */
abstract class AbstractEsiRequestFactory
{
    /**
     * @var RequestInterface
     */
    protected RequestInterface $requestPrototype;

    /**
     * @required
     *
     * @param RequestInterface $requestPrototype
     */
    public function setRequestPrototype(RequestInterface $requestPrototype): void
    {
        $this->requestPrototype = $requestPrototype;
    }

    /**
     * @param string      $endpoint
     * @param string|null $accessToken
     * @param object|null $query
     * @param object|null $body
     * @param string|null $eTag
     *
     * @return RequestInterface
     */
    protected function doCreateRequest(
        string $endpoint,
        string $accessToken = null,
        object $query = null,
        object $body = null,
        string $eTag = null
    ): RequestInterface
    {
        $request = clone $this->requestPrototype;
        $request->setEndpoint($endpoint)
                ->setQuery($query)
                ->setBody($body);

        if ($accessToken) {
            $request->setHeader(
                'Authorization',
                sprintf('Bearer %s', $accessToken)
            );
        }

        if ($eTag) {
            $request->setHeader('If-None-Match', $eTag);
        }

        return $request;
    }
}