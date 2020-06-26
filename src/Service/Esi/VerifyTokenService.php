<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\Esi;

use F1Monkey\EveEsiBundle\Dto\Esi\Response\VerifyAccessTokenResponse;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Factory\Esi\VerifyAccessTokenRequestFactoryInterface;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;

/**
 * Class EsiService
 *
 * @package F1Monkey\EveEsiBundle\Service\Esi
 */
class VerifyTokenService implements VerifyTokenServiceInterface
{
    /**
     * @var ApiClientInterface
     */
    protected ApiClientInterface $apiClient;

    /**
     * @var VerifyAccessTokenRequestFactoryInterface
     */
    protected VerifyAccessTokenRequestFactoryInterface $requestFactory;

    /**
     * VerifyTokenService constructor.
     *
     * @param ApiClientInterface                       $apiClient
     * @param VerifyAccessTokenRequestFactoryInterface $requestFactory
     */
    public function __construct(ApiClientInterface $apiClient, VerifyAccessTokenRequestFactoryInterface $requestFactory)
    {
        $this->apiClient      = $apiClient;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param string $accessToken
     *
     * @return VerifyAccessTokenResponse
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function verifyAccessToken(string $accessToken): VerifyAccessTokenResponse
    {
        $request = $this->requestFactory->createVerifyAccessTokenRequest($accessToken);
        /** @var VerifyAccessTokenResponse $response */
        $response = $this->apiClient->get($request, VerifyAccessTokenResponse::class);

        return $response;
    }
}