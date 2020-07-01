<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

/**
 * Class V2CharactersOrdersResponse
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
class CharactersOrdersResponseV2
{
    use OrderTrait;
    use HasRegionIdTrait;
    use HasEscrowTrait;
    use HasIsCorporationTrait;
}