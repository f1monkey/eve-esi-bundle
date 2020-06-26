<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\ApiClient;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Interface ApiClientInterface
 *
 * @package F1monkey\EveEsiBundle\Service\ApiClient
 */
interface ApiClientInterface
{
    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function get(RequestInterface $request, string $responseClass): object;

    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function post(RequestInterface $request, string $responseClass): object;
}