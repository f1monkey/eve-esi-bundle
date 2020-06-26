<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\OAuth;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\OAuth\Response\TokenResponse;
use F1monkey\EveEsiBundle\Dto\Scope;
use F1monkey\EveEsiBundle\Enum\OAuthEnum;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1monkey\EveEsiBundle\Exception\OAuth\InvalidTokenTypeException;
use F1monkey\EveEsiBundle\Factory\OAuth\OAuthRequestFactoryInterface;
use F1monkey\EveEsiBundle\Factory\OAuth\RedirectUrlFactoryInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use function in_array;

/**
 * Class OAuthService
 *
 * @package F1monkey\EveEsiBundle\Service\OAuth
 */
class OAuthService implements OAuthServiceInterface
{
    /**
     * @var RedirectUrlFactoryInterface
     */
    protected RedirectUrlFactoryInterface $redirectUrlFactory;

    /**
     * @var OAuthRequestFactoryInterface
     */
    protected OAuthRequestFactoryInterface $oauthRequestFactory;

    /**
     * @var ApiClientInterface
     */
    protected ApiClientInterface $apiClient;

    /**
     * OAuthService constructor.
     *
     * @param RedirectUrlFactoryInterface  $redirectUrlFactory
     * @param OAuthRequestFactoryInterface $oauthRequestFactory
     * @param ApiClientInterface           $apiClient
     */
    public function __construct(
        RedirectUrlFactoryInterface $redirectUrlFactory,
        OAuthRequestFactoryInterface $oauthRequestFactory,
        ApiClientInterface $apiClient
    )
    {
        $this->redirectUrlFactory  = $redirectUrlFactory;
        $this->oauthRequestFactory = $oauthRequestFactory;
        $this->apiClient           = $apiClient;
    }

    /**
     * Generate URL to redirect user for authentication
     *
     * @param Collection<int, Scope> $scopes
     *
     * @return string
     * @throws InvalidScopeCodeException
     * @throws EmptyScopeCollectionException
     */
    public function createRedirectUrl(Collection $scopes): string
    {
        return $this->redirectUrlFactory->createRedirectUrl($scopes);
    }

    /**
     * Get access and refresh tokens by authenticated user's authorization code
     *
     * @param string $authorizationCode
     *
     * @return TokenResponse
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function verifyCode(string $authorizationCode): TokenResponse
    {
        $request = $this->oauthRequestFactory->createVerifyCodeRequest($authorizationCode);

        /** @var TokenResponse $result */
        $result = $this->apiClient->post($request, TokenResponse::class);

        if (!in_array($result->getTokenType(), OAuthEnum::TOKEN_TYPES, true)) {
            throw new InvalidTokenTypeException(
                sprintf('Invalid token type "%s"', $result->getTokenType())
            );
        }

        return $result;
    }

    /**
     * Get new access token from EVE SSO
     *
     * @param string $refreshToken
     *
     * @return TokenResponse
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function refreshToken(string $refreshToken): TokenResponse
    {
        $request = $this->oauthRequestFactory->createRefreshTokenRequest($refreshToken);

        /** @var TokenResponse $result */
        $result = $this->apiClient->post($request, TokenResponse::class);

        if (!in_array($result->getTokenType(), OAuthEnum::TOKEN_TYPES, true)) {
            throw new InvalidTokenTypeException(
                sprintf('Invalid token type "%s"', $result->getTokenType())
            );
        }

        return $result;
    }
}