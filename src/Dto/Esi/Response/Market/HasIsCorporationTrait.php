<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

use JMS\Serializer\Annotation as Serializer;

/**
 * Trait HasIsCorporationTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
trait HasIsCorporationTrait
{
    /**
     * @var bool
     *
     * @Serializer\SerializedName("is_corporation")
     * @Serializer\Type("boolean")
     */
    protected bool $isCorporation;

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
}