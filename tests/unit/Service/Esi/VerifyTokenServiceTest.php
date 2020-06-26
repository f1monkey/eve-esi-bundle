<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Service\Esi;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Dto\Esi\Response\VerifyAccessTokenResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Factory\Esi\VerifyAccessTokenRequestFactoryInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1monkey\EveEsiBundle\Service\Esi\VerifyTokenService;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class VerifyTokenServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Service\Esi
 */
class VerifyTokenServiceTest extends Unit
{
    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanVerifyAccessToken()
    {
        $expected = new VerifyAccessTokenResponse();
        /** @var ApiClientInterface $client */
        $client = $this->makeEmpty(
            ApiClientInterface::class,
            [
                'get' => $expected,
            ]
        );
        /** @var VerifyAccessTokenRequestFactoryInterface $factory */
        $factory = $this->makeEmpty(
            VerifyAccessTokenRequestFactoryInterface::class,
            [
                'createVerifyAccessTokenRequest' => $this->makeEmpty(RequestInterface::class),
            ]
        );

        $service = new VerifyTokenService($client, $factory);
        $result = $service->verifyAccessToken('token');

        $this->assertSame($expected, $result);
    }
}