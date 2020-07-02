<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response\Market;

use JMS\Serializer\Annotation as Serializer;

/**
 * Trait HasStateTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response\Market
 */
trait HasStateTrait
{
    /**
     * @var string
     *
     * @Serializer\SerializedName("state")
     * @Serializer\Type("string")
     */
    protected string $state;

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
}