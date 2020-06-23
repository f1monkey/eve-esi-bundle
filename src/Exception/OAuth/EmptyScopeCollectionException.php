<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception\OAuth;

use OutOfBoundsException;

/**
 * Class ScopesRequiredException
 *
 * @package F1Monkey\EveEsiBundle\Exception\OAuth
 */
class EmptyScopeCollectionException extends OutOfBoundsException implements OAuthExceptionInterface
{

}