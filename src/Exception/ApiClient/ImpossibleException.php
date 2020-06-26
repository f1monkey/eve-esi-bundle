<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\ApiClient;

use LogicException;

/**
 * Class ImpossibleException
 *
 * @package F1monkey\EveEsiBundle\Exception\ApiClient
 */
class ImpossibleException extends LogicException implements ApiClientExceptionInterface
{

}