<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\Esi;

use F1monkey\EveEsiBundle\Dto\Esi\Request\GenericPaginatedRequest;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class MarketRequestFactory
 *
 * @package F1monkey\EveEsiBundle\Factory\Esi
 *
 * @internal
 */
class MarketRequestFactory extends AbstractEsiRequestFactory implements MarketRequestFactoryInterface
{
    /**
     * @param string   $accessToken
     * @param int      $characterId
     * @param int|null $page
     *
     * @return RequestInterface
     */
    public function createV1CharacterOrderHistoryRequest(
        string $accessToken,
        int $characterId,
        int $page = null
    ): RequestInterface
    {
        return $this->doCreateRequest(
            sprintf('/v1/characters/%s/orders/history/', $characterId),
            $accessToken,
            new GenericPaginatedRequest($page)
        );
    }

    /**
     * @param string $accessToken
     * @param int    $characterId
     *
     * @return RequestInterface
     */
    public function createV2CharactersOrdersRequest(string $accessToken, int $characterId): RequestInterface
    {
        return $this->doCreateRequest(
            sprintf('/v2/characters/%s/orders/', $characterId),
            $accessToken
        );
    }
}