<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class EsiResponseCollection
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response
 *
 * @phpstan-ignore-next-line
 */
class EsiResponseCollection extends ArrayCollection implements HasETagInterface, HasPageCountInterface
{
    use HasETagTrait;
    use HasPageCountTrait;
}