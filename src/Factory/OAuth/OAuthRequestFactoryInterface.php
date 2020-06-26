<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\OAuth;

use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Interface OAuthRequestFactoryInterface
 *
 * @package F1monkey\EveEsiBundle\Factory\OAuth
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