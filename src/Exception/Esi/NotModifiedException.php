<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Exception\Esi;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use RuntimeException;

/**
 * Class NotModifiedException
 *
 * @package F1monkey\EveEsiBundle\Exception\Esi
 */
class NotModifiedException extends RuntimeException implements EsiExceptionInterface, ApiClientExceptionInterface
{

}