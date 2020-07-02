<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\Esi;

use F1monkey\EveEsiBundle\Dto\Esi\Response\EsiResponseCollection;
use F1monkey\EveEsiBundle\Dto\Esi\Response\Market\CharactersOrdersHistoryResponseV1;
use F1monkey\EveEsiBundle\Dto\Esi\Response\Market\CharactersOrdersResponseV2;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\Esi\NotModifiedException;
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
     * @param string      $accessToken
     * @param int         $characterId
     * @param int|null    $page
     * @param string|null $eTag
     *
     * @return EsiResponseCollection<int, CharactersOrdersHistoryResponseV1>
     * @throws ApiClientExceptionInterface
     * @throws NotModifiedException
     * @throws RequestValidationException
     */
    public function getV1CharactersOrdersHistory(
        string $accessToken,
        int $characterId,
        int $page = null,
        string $eTag = null
    ): EsiResponseCollection
    {
        $request = $this->requestFactory->createV1CharacterOrderHistoryRequest($accessToken, $characterId, $page, $eTag);

        /** @var EsiResponseCollection<int, CharactersOrdersHistoryResponseV1> $response */
        $response = $this->apiClient->get(
            $request,
            sprintf('ArrayCollection<int, %s>', CharactersOrdersHistoryResponseV1::class)
        );

        return $response;
    }

    /**
     * GET /v2/characters/{character_id}/orders/
     *
     * @see https://esi.evetech.net/ui/?version=_latest#/Market/get_characters_character_id_orders
     *
     * @param string      $accessToken
     * @param int         $characterId
     * @param string|null $eTag
     *
     * @return EsiResponseCollection<int, CharactersOrdersResponseV2>
     * @throws ApiClientExceptionInterface
     * @throws NotModifiedException
     * @throws RequestValidationException
     */
    public function getV2CharactersOrders(
        string $accessToken,
        int $characterId,
        string $eTag = null
    ): EsiResponseCollection
    {
        $request = $this->requestFactory->createV2CharactersOrdersRequest($accessToken, $characterId, $eTag);

        /** @var EsiResponseCollection<int, CharactersOrdersResponseV2> $response */
        $response = $this->apiClient->get(
            $request,
            sprintf('ArrayCollection<int, %s>', CharactersOrdersResponseV2::class)
        );

        return $response;
    }
}