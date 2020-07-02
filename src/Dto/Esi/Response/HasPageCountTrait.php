<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response;

/**
 * Trait HasMaxPageTrait
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response
 */
trait HasPageCountTrait
{
    /**
     * @var int|null
     */
    protected ?int $pageCount = null;

    /**
     * @return int|null
     */
    public function getPageCount(): ?int
    {
        return $this->pageCount;
    }

    /**
     * @param int|null $pageCount
     *
     * @return $this
     *
     * @phpstan-ignore-next-line
     */
    public function setPageCount(?int $pageCount)
    {
        $this->pageCount = $pageCount;

        return $this;
    }
}