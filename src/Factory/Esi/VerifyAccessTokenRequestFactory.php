<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Factory\Esi;

use F1monkey\EveEsiBundle\ValueObject\RequestInterface;

/**
 * Class VerifyAccessTokenRequestFactory
 *
 * @package F1monkey\EveEsiBundle\Factory\Esi
 */
class VerifyAccessTokenRequestFactory extends AbstractEsiRequestFactory implements VerifyAccessTokenRequestFactoryInterface
{
    /**
     * @param string $accessToken
     *
     * @return RequestInterface
     */
    public function createVerifyAccessTokenRequest(string $accessToken): RequestInterface
    {
        return $this->doCreateRequest('/verify', $accessToken);
    }
}