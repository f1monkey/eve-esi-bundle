<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response;

/**
 * Interface HasPageCountInterface
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response
 */
interface HasPageCountInterface
{
    /**
     * @return int|null
     */
    public function getPageCount(): ?int;

    /**
     * @param int|null $pageCount
     *
     * @return $this
     */
    public function setPageCount(?int $pageCount);
}