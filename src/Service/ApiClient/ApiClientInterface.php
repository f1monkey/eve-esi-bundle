<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;

/**
 * Interface ApiClientInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 */
interface ApiClientInterface
{
    /**
     * @param string                $endpoint
     * @param object                $body
     *
     * @return string
     * @throws RequestValidationException
     */
    public function post(string $endpoint, object $body): string;
}