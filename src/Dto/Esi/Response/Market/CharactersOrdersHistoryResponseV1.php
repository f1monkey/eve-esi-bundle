<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

/**
 * Class V1CharactersOrdersHistoryResponse
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
class CharactersOrdersHistoryResponseV1
{
    use OrderTrait;
    use HasRegionIdTrait;
    use HasEscrowTrait;
    use HasIsCorporationTrait;
    use HasStateTrait;
}