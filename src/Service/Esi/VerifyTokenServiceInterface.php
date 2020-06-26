<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\Esi;

use F1Monkey\EveEsiBundle\Dto\Esi\Response\VerifyAccessTokenResponse;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Exception\Esi\EsiRequestException;

/**
 * Interface VerifyTokenServiceInterface
 *
 * @package F1Monkey\EveEsiBundle\Service\Esi
 */
interface VerifyTokenServiceInterface
{
    /**
     * @param string $accessToken
     *
     * @return VerifyAccessTokenResponse
     * @throws EsiRequestException
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     */
    public function verifyAccessToken(string $accessToken): VerifyAccessTokenResponse;
}