<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Service\Esi;

use Codeception\Test\Unit;
use Exception;
use F1Monkey\EveEsiBundle\Dto\Esi\Response\VerifyAccessTokenResponse;
use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Factory\Esi\VerifyAccessTokenRequestFactoryInterface;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1Monkey\EveEsiBundle\Service\Esi\VerifyTokenService;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class VerifyTokenServiceTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Service\Esi
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