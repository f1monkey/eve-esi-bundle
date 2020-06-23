<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\OAuth;

use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;

/**
 * Interface OAuthServiceInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\OAuth
 */
interface OAuthServiceInterface
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