<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\Esi;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\OAuth\Response\Market\V1CharactersOrdersHistoryResponse;
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
     * @return Collection<int, V1CharactersOrdersHistoryResponse>
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function getV1CharactersOrdersHistory(string $accessToken, int $characterId, int $page = null): Collection;
}