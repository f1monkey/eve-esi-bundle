<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\OAuth;

use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\OAuth\Response\TokenResponse;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1Monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;

/**
 * Interface OAuthServiceInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\OAuth
 */
interface OAuthServiceInterface
{
    /**
     * Generate URL to redirect user for authentication
     *
     * @param Collection<int, Scope> $scopes
     *
     * @return string
     * @throws InvalidScopeCodeException
     * @throws OAuthRequestException
     * @throws EmptyScopeCollectionException
     */
    public function createRedirectUrl(Collection $scopes): string;

    /**
     * Get access and refresh tokens by authenticated user's authorization code
     *
     * @param string $authorizationCode
     *
     * @return TokenResponse
     * @throws RequestValidationException
     * @throws OAuthRequestException
     * @throws ApiClientExceptionInterface
     */
    public function verifyCode(string $authorizationCode): TokenResponse;

    /**
     * Get new access token from EVE SSO
     *
     * @param string $refreshToken
     *
     * @return TokenResponse
     * @throws RequestValidationException
     * @throws OAuthRequestException
     * @throws ApiClientExceptionInterface
     */
    public function refreshToken(string $refreshToken): TokenResponse;
}