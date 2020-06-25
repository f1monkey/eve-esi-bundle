<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception\OAuth;

use LogicException;

/**
 * Class InvalidTokenTypeException
 *
 * @package F1Monkey\EveEsiBundle\Exception\OAuth
 */
class InvalidTokenTypeException extends LogicException implements OAuthExceptionInterface
{

}