<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\OAuth;

use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Interface OAuthRequestFactoryInterface
 *
 * @package F1Monkey\EveEsiBundle\Factory\OAuth
 */
interface OAuthRequestFactoryInterface
{
    /**
     * @param string $authorizationCode
     *
     * @return RequestInterface
     */
    public function createVerifyCodeRequest(string $authorizationCode): RequestInterface;

    /**
     * @param string $refreshToken
     *
     * @return RequestInterface
     */
    public function createRefreshTokenRequest(string $refreshToken): RequestInterface;
}