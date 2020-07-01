<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\Esi;

use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Interface MarketRequestFactoryInterface
 *
 * @package F1monkey\EveEsiBundle\Factory\Esi
 */
interface MarketRequestFactoryInterface
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
    ): RequestInterface;
}