<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Response\Market;

use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class V1CharactersOrdersHistoryResponse
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Response\Market
 */
class V1CharactersOrdersHistoryResponse
{
    /**
     * @var int
     *
     * @Serializer\SerializedName("duration")
     * @Serializer\Type("int")
     */
    protected int $duration;

    /**
     * @var float
     *
     * @Serializer\SerializedName("escrow")
     * @Serializer\Type("float")
     */
    protected float $escrow;

    /**
     * @var bool
     *
     * @Serializer\SerializedName("is_buy_order")
     * @Serializer\Type("boolean")
     */
    protected bool $isBuyOrder;

    /**
     * @var bool
     *
     * @Serializer\SerializedName("is_corporation")
     * @Serializer\Type("boolean")
     */
    protected bool $isCorporation;

    /**
     * @var DateTimeInterface
     *
     * @Serializer\SerializedName("issued")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d\TH:i:s\Z', 'UTC'>")
     */
    protected DateTimeInterface $issued;

    /**
     * @var int
     *
     * @Serializer\SerializedName("location_id")
     * @Serializer\Type("int")
     */
    protected int $locationId;

    /**
     * @var int|null
     *
     * @Serializer\SerializedName("min_volume")
     * @Serializer\Type("int")
     */
    protected ?int $minVolume = null;

    /**
     * @var int
     *
     * @Serializer\SerializedName("order_id")
     * @Serializer\Type("int")
     */
    protected int $orderId;

    /**
     * @var float
     *
     * @Serializer\SerializedName("price")
     * @Serializer\Type("float")
     */
    protected float $price;

    /**
     * @var string
     *
     * @Serializer\SerializedName("range")
     * @Serializer\Type("string")
     */
    protected string $range;

    /**
     * @var int
     *
     * @Serializer\SerializedName("region_id")
     * @Serializer\Type("int")
     */
    protected int $regionId;

    /**
     * @var string
     *
     * @Serializer\SerializedName("state")
     * @Serializer\Type("string")
     */
    protected string $state;

    /**
     * @var int
     *
     * @Serializer\SerializedName("type_id")
     * @Serializer\Type("int")
     */
    protected int $typeId;

    /**
     * @var int
     *
     * @Serializer\SerializedName("volume_remain")
     * @Serializer\Type("int")
     */
    protected int $volumeRemain;

    /**
     * @var int
     *
     * @Serializer\SerializedName("volume_total")
     * @Serializer\Type("int")
     */
    protected int $volumeTotal;

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     *
     * @return $this
     */
    public function setDuration(int $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return float
     */
    public function getEscrow(): float
    {
        return $this->escrow;
    }

    /**
     * @param float $escrow
     *
     * @return $this
     */
    public function setEscrow(float $escrow)
    {
        $this->escrow = $escrow;

        return $this;
    }

    /**
     * @return bool
     */
    public function isBuyOrder(): bool
    {
        return $this->isBuyOrder;
    }

    /**
     * @param bool $isBuyOrder
     *
     * @return $this
     */
    public function setIsBuyOrder(bool $isBuyOrder)
    {
        $this->isBuyOrder = $isBuyOrder;

        return $this;
    }

    /**
     * @return bool
     */
    public function isCorporation(): bool
    {
        return $this->isCorporation;
    }

    /**
     * @param bool $isCorporation
     *
     * @return $this
     */
    public function setIsCorporation(bool $isCorporation)
    {
        $this->isCorporation = $isCorporation;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getIssued(): DateTimeInterface
    {
        return $this->issued;
    }

    /**
     * @param DateTimeInterface $issued
     *
     * @return $this
     */
    public function setIssued(DateTimeInterface $issued)
    {
        $this->issued = $issued;

        return $this;
    }

    /**
     * @return int
     */
    public function getLocationId(): int
    {
        return $this->locationId;
    }

    /**
     * @param int $locationId
     *
     * @return $this
     */
    public function setLocationId(int $locationId)
    {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinVolume(): ?int
    {
        return $this->minVolume;
    }

    /**
     * @param int|null $minVolume
     *
     * @return $this
     */
    public function setMinVolume(?int $minVolume)
    {
        $this->minVolume = $minVolume;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     *
     * @return $this
     */
    public function setOrderId(int $orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getRange(): string
    {
        return $this->range;
    }

    /**
     * @param string $range
     *
     * @return $this
     */
    public function setRange(string $range)
    {
        $this->range = $range;

        return $this;
    }

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

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return $this
     */
    public function setState(string $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return int
     */
    public function getTypeId(): int
    {
        return $this->typeId;
    }

    /**
     * @param int $typeId
     *
     * @return $this
     */
    public function setTypeId(int $typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * @return int
     */
    public function getVolumeRemain(): int
    {
        return $this->volumeRemain;
    }

    /**
     * @param int $volumeRemain
     *
     * @return $this
     */
    public function setVolumeRemain(int $volumeRemain)
    {
        $this->volumeRemain = $volumeRemain;

        return $this;
    }

    /**
     * @return int
     */
    public function getVolumeTotal(): int
    {
        return $this->volumeTotal;
    }

    /**
     * @param int $volumeTotal
     *
     * @return $this
     */
    public function setVolumeTotal(int $volumeTotal)
    {
        $this->volumeTotal = $volumeTotal;

        return $this;
    }
}