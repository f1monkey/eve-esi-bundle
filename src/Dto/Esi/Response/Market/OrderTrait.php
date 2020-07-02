<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

use DateTimeInterface;
use JMS\Serializer\Annotation as Serializer;

/**
 * Trait OrderTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
trait OrderTrait
{
    /**
     * @var int
     *
     * @Serializer\SerializedName("duration")
     * @Serializer\Type("int")
     */
    protected int $duration;

    /**
     * @var bool
     *
     * @Serializer\SerializedName("is_buy_order")
     * @Serializer\Type("boolean")
     */
    protected bool $isBuyOrder = false;

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