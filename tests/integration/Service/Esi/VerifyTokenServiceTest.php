<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\Service\Esi;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;
use F1monkey\EveEsiBundle\Service\Esi\VerifyTokenServiceInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class VerifyTokenServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\Service\Esi
 */
class VerifyTokenServiceTest extends AbstractEsiTestCase
{
    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws OAuthRequestException
     * @throws ExpectationFailedException
     */
    public function testCanVerifyAuthorizationCode()
    {
        $response = <<<JSON
{
    "CharacterID": 12345678,
    "CharacterName": "User",
    "ExpiresOn": "2020-06-25T23:20:58",
    "Scopes": "publicData",
    "TokenType": "Character",
    "CharacterOwnerHash": "WNBkwRetNpVbYpJ04sAoNXwLiZY=",
    "IntellectualProperty": "EVE"
}
JSON;
        $this->httpMock->setResponse($response);

        /** @var VerifyTokenServiceInterface $service */
        $service = $this->tester->grabService('test.f1monkey.eve_esi.verify_token_service');
        $result  = $service->verifyAccessToken('code');

        static::assertSame('Character', $result->getTokenType());
        static::assertSame(12345678, $result->getCharacterId());
    }
}