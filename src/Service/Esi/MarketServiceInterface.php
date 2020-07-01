<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\Esi;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\Esi\Response\Market\CharactersOrdersHistoryResponseV1;
use F1monkey\EveEsiBundle\Dto\Esi\Response\Market\CharactersOrdersResponseV2;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;

/**
 * Class MarketService
 *
 * @package F1monkey\EveEsiBundle\Service\Esi
 */
interface MarketServiceInterface
{
    /**
     * GET /v1/characters/{character_id}/orders/history/
     *
     * @see https://esi.evetech.net/ui/?version=_latest#/Market/get_characters_character_id_orders_history
     *
     * @param string   $accessToken
     * @param int      $characterId
     * @param int|null $page
     *
     * @return Collection<int, CharactersOrdersHistoryResponseV1>
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function getV1CharactersOrdersHistory(string $accessToken, int $characterId, int $page = null): Collection;

    /**
     * GET /v2/characters/{character_id}/orders/
     *
     * @see https://esi.evetech.net/ui/?version=_latest#/Market/get_characters_character_id_orders
     *
     * @param string   $accessToken
     * @param int      $characterId
     *
     * @return Collection<int, CharactersOrdersResponseV2>
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function getV2CharactersOrders(string $accessToken, int $characterId): Collection;
}