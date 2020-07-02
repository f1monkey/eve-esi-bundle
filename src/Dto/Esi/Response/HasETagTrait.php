<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response;

/**
 * Trait HasETagTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response
 */
trait HasETagTrait
{
    /**
     * @var string|null
     */
    protected ?string $eTag = null;

    /**
     * @return string|null
     */
    public function getETag(): ?string
    {
        return $this->eTag;
    }

    /**
     * @param string|null $eTag
     *
     * @return $this
     *
     * @phpstan-ignore-next-line
     */
    public function setETag(?string $eTag)
    {
        $this->eTag = $eTag;

        return $this;
    }
}