<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\ApiClient;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use GuzzleHttp\Exception\RequestException;

/**
 * Interface ExceptionFactoryInterface
 *
 * @package F1monkey\EveEsiBundle\Service\ApiClient
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