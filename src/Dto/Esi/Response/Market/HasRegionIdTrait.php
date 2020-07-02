<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

use JMS\Serializer\Annotation as Serializer;

/**
 * Trait HasRegionIdTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
trait HasRegionIdTrait
{
    /**
     * @var int
     *
     * @Serializer\SerializedName("region_id")
     * @Serializer\Type("int")
     */
    protected int $regionId;

    /**
     * @return int
     */
    public function getRegionId(): int
    {
        return $this->regionId;
    }

    /**
     * @param int $regionId
     *
     * @return $this
     */
    public function setRegionId(int $regionId)
    {
        $this->regionId = $regionId;

        return $this;
    }
}