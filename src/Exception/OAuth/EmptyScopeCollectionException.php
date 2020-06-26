<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\OAuth;

use OutOfBoundsException;

/**
 * Class ScopesRequiredException
 *
 * @package F1monkey\EveEsiBundle\Exception\OAuth
 */
class EmptyScopeCollectionException extends OutOfBoundsException implements OAuthExceptionInterface
{

}