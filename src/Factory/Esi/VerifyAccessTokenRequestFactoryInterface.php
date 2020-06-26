<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\Esi;

use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class VerifyAccessTokenRequestFactory
 *
 * @package F1Monkey\EveEsiBundle\Factory\Esi
 */
interface VerifyAccessTokenRequestFactoryInterface
{
    /**
     * @param string $accessToken
     *
     * @return RequestInterface
     */
    public function createVerifyAccessTokenRequest(string $accessToken): RequestInterface;
}