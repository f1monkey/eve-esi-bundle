<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

use JMS\Serializer\Annotation as Serializer;

/**
 * Trait HasEscrowTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
trait HasEscrowTrait
{
    /**
     * @var float|null
     *
     * @Serializer\SerializedName("escrow")
     * @Serializer\Type("float")
     */
    protected ?float $escrow = null;

    /**
     * @return float|null
     */
    public function getEscrow(): ?float
    {
        return $this->escrow;
    }

    /**
     * @param float|null $escrow
     *
     * @return $this
     */
    public function setEscrow(?float $escrow)
    {
        $this->escrow = $escrow;

        return $this;
    }
}