<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\OAuth;

use F1Monkey\EveEsiBundle\Dto\OAuth\Request\RefreshTokenRequest;
use F1Monkey\EveEsiBundle\Dto\OAuth\Request\VerifyCodeRequest;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class OAuthRequestFactory
 *
 * @package F1Monkey\EveEsiBundle\Factory\OAuth
 *
 * @internal
 */
class OAuthRequestFactory implements OAuthRequestFactoryInterface
{
    /**
     * @var RequestInterface
     */
    protected RequestInterface $requestPrototype;

    /**
     * OAuthRequestFactory constructor.
     *
     * @param RequestInterface $requestPrototype
     */
    public function __construct(RequestInterface $requestPrototype)
    {
        $this->requestPrototype = $requestPrototype;
    }

    /**
     * @param string $authorizationCode
     *
     * @return RequestInterface
     */
    public function createVerifyCodeRequest(string $authorizationCode): RequestInterface
    {
        $requestData = new VerifyCodeRequest($authorizationCode);

        return $this->doCreateRequest('./oauth/token', $requestData);
    }

    /**
     * @param string $refreshToken
     *
     * @return RequestInterface
     */
    public function createRefreshTokenRequest(string $refreshToken): RequestInterface
    {
        $requestData = new RefreshTokenRequest($refreshToken);

        return $this->doCreateRequest('./oauth/token', $requestData);
    }

    /**
     * @param string $endpoint
     * @param object $requestData
     *
     * @return RequestInterface
     */
    protected function doCreateRequest(string $endpoint, object $requestData = null): RequestInterface
    {
        $request = clone $this->requestPrototype;
        $request->setEndpoint($endpoint)
                ->setRequest($requestData);

        return $request;
    }
}