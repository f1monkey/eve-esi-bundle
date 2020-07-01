<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\Esi\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GenericPaginatedRequest
 *
 * @package F1monkey\EveEsiBundle\Dto\Esi\Request
 */
class GenericPaginatedRequest
{
    /**
     * @var int|null
     *
     * @Serializer\SerializedName("page")
     * @Serializer\Type("int")
     *
     * @Assert\GreaterThan(0)
     */
    protected ?int $page;

    /**
     * GenericPaginatedRequest constructor.
     *
     * @param int|null $page
     */
    public function __construct(?int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }
}