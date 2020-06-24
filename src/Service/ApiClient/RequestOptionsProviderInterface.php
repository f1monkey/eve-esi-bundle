<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

/**
 * Interface RequestOptionsProviderInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 */
interface RequestOptionsProviderInterface
{
    /**
     * @param object $request
     *
     * @return array<string, mixed>
     */
    public function createPostRequestOptions(object $request): array;
}