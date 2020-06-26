<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\OAuth;

use LogicException;

/**
 * Class InvalidTokenTypeException
 *
 * @package F1monkey\EveEsiBundle\Exception\OAuth
 */
class InvalidTokenTypeException extends LogicException implements OAuthExceptionInterface
{

}