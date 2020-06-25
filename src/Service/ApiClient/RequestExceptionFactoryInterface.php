<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Interface ExceptionFactoryInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 */
interface RequestExceptionFactoryInterface
{
    /**
     * @param RequestException $exception
     *
     * @return ApiClientExceptionInterface
     */
    public function createRequestException(RequestException $exception): ApiClientExceptionInterface;
}