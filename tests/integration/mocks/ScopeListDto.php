<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\mocks;

use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\Scope;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ScopeListDto
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\mocks
 */
class ScopeListDto
{
    /**
     * @var Collection<int, Scope>
     *
     * @Serializer\SerializedName("scopes")
     * @Serializer\Type("eve_esi_scopes")
     */
    protected Collection $scopes;

    /**
     * ScopeListDto constructor.
     *
     * @param Collection $scopes
     */
    public function __construct(Collection $scopes)
    {
        $this->scopes = $scopes;
    }

    /**
     * @return Collection
     */
    public function getScopes(): Collection
    {
        return $this->scopes;
    }
}