<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception\OAuth;

use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use OutOfBoundsException;
use Throwable;

/**
 * Class InvalidScopeCodeException
 *
 * @package F1Monkey\EveEsiBundle\Exception\OAuth
 */
class InvalidScopeCodeException extends OutOfBoundsException implements OAuthExceptionInterface
{
    /**
     * @var Collection<int, Scope>
     */
    protected Collection $invalidScopes;

    /**
     * InvalidScopeCodeException constructor.
     *
     * @param Collection<int, Scope> $invalidScopes
     * @param string                 $message
     * @param int                    $code
     * @param Throwable|null         $previous
     */
    public function __construct(Collection $invalidScopes, $message = '', $code = 0, Throwable $previous = null)
    {
        $this->invalidScopes = $invalidScopes;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return Collection<int, Scope>
     */
    public function getInvalidScopes(): Collection
    {
        return $this->invalidScopes;
    }
}