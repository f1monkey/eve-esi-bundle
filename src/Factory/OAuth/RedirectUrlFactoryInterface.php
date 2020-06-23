<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\OAuth;

use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;

/**
 * Interface RedirectUrlFactoryInterface
 *
 * @package F1Monkey\EveEsiBundle\Factory\OAuth
 */
interface RedirectUrlFactoryInterface
{
    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return string
     * @throws InvalidScopeCodeException
     * @throws EmptyScopeCollectionException
     */
    public function createRedirectUrl(Collection $scopes): string;
}