<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Interface ApiClientInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
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