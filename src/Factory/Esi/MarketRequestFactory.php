<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\Esi;

use F1monkey\EveEsiBundle\Dto\OAuth\Request\GenericPaginatedRequest;
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
     * @param string $accessToken
     * @param int $characterId
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
}