<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\OAuth;

use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1Monkey\EveEsiBundle\Factory\OAuth\RedirectUrlFactoryInterface;

/**
 * Class OAuthService
 *
 * @package F1Monkey\EveEsiBundle\Service\OAuth
 */
class OAuthService implements OAuthServiceInterface
{
    /**
     * @var RedirectUrlFactoryInterface
     */
    protected RedirectUrlFactoryInterface $redirectUrlFactory;

    /**
     * OAuthService constructor.
     *
     * @param RedirectUrlFactoryInterface $redirectUrlFactory
     */
    public function __construct(RedirectUrlFactoryInterface $redirectUrlFactory)
    {
        $this->redirectUrlFactory = $redirectUrlFactory;
    }

    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return string
     * @throws InvalidScopeCodeException
     * @throws EmptyScopeCollectionException
     */
    public function createRedirectUrl(Collection $scopes): string
    {
        return $this->redirectUrlFactory->createRedirectUrl($scopes);
    }
}