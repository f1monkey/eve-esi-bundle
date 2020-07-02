<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Response;

/**
 * Interface HasETagInterface
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Response
 */
interface HasETagInterface
{
    /**
     * @return string|null
     */
    public function getETag(): ?string;

    /**
     * @param string|null $eTag
     *
     * @return $this
     */
    public function setETag(?string $eTag);
}