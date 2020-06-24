<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Exception\ApiClient;

use LogicException;

/**
 * Class ImpossibleException
 *
 * @package F1Monkey\EveEsiBundle\Exception\ApiClient
 */
class ImpossibleException extends LogicException implements ApiClientExceptionInterface
{

}