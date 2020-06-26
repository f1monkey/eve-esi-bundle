<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\Esi;

use F1monkey\EveEsiBundle\Dto\Esi\Response\VerifyAccessTokenResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\Esi\EsiRequestException;

/**
 * Interface VerifyTokenServiceInterface
 *
 * @package F1monkey\EveEsiBundle\Service\Esi
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