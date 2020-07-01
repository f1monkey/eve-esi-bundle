<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\Esi;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\OAuth\Response\Market\V1CharactersOrdersHistoryResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Factory\Esi\MarketRequestFactoryInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;

/**
 * Class MarketService
 *
 * @package F1monkey\EveEsiBundle\Service\Esi
 */
class MarketService implements MarketServiceInterface
{
    /**
     * @var ApiClientInterface
     */
    protected ApiClientInterface $apiClient;

    /**
     * @var MarketRequestFactoryInterface
     */
    protected MarketRequestFactoryInterface $requestFactory;

    /**
     * MarketService constructor.
     *
     * @param ApiClientInterface            $apiClient
     * @param MarketRequestFactoryInterface $requestFactory
     */
    public function __construct(ApiClientInterface $apiClient, MarketRequestFactoryInterface $requestFactory)
    {
        $this->apiClient      = $apiClient;
        $this->requestFactory = $requestFactory;
    }

    /**
     * GET /v1/characters/{character_id}/orders/history/
     *
     * @see https://esi.evetech.net/ui/?version=_latest#/Market/get_characters_character_id_orders_history
     *
     * @param string   $accessToken
     * @param int      $characterId
     * @param int|null $page
     *
     * @return Collection<int, V1CharactersOrdersHistoryResponse>
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function getV1CharactersOrdersHistory(string $accessToken, int $characterId, int $page = null): Collection
    {
        $request = $this->requestFactory->createV1CharacterOrderHistoryRequest($accessToken, $characterId, $page);

        /** @var Collection<int, V1CharactersOrdersHistoryResponse> $response */
        $response = $this->apiClient->get(
            $request,
            sprintf('ArrayCollection<int, %s>', V1CharactersOrdersHistoryResponse::class)
        );

        return $response;
    }
}