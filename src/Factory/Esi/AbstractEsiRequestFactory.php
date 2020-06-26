<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\Esi;

use F1Monkey\EveEsiBundle\ValueObject\EsiRequest;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class AbstractEsiRequestFactory
 *
 * @package F1Monkey\EveEsiBundle\Factory\Esi
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
     * @param string $endpoint
     * @param string|null $accessToken
     * @param object $requestData
     *
     * @return RequestInterface
     */
    protected function doCreateRequest(
        string $endpoint,
        string $accessToken = null,
        object $requestData = null
    ): RequestInterface
    {
        $request = clone $this->requestPrototype;
        $request->setEndpoint($endpoint)
                ->setRequest($requestData);

        if ($request instanceof EsiRequest) {
            $request->setAccessToken($accessToken);
        }

        return $request;
    }
}