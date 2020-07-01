<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Request;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class GenericPaginatedRequest
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Request
 */
class GenericPaginatedRequest
{
    /**
     * @var int|null
     *
     * @Serializer\SerializedName("page")
     * @Serializer\Type("int")
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
}