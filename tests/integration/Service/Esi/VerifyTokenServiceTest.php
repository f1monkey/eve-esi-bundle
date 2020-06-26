<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\Service\Esi;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClient;
use F1monkey\EveEsiBundle\Service\Esi\VerifyTokenServiceInterface;
use F1monkey\EveEsiBundle\Tests\integration\AbstractIntegrationTestCase;
use F1monkey\EveEsiBundle\Tests\integration\mocks\HttpClientMock;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class VerifyTokenServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\Service\Esi
 */
class VerifyTokenServiceTest extends AbstractIntegrationTestCase
{
    /**
     * @var HttpClientMock
     */
    protected HttpClientMock $httpMock;

    public function _before()
    {
        parent::_before();
        /** @var ApiClient $client */
        $this->httpMock = new HttpClientMock();
        $client         = $this->tester->grabService('test.f1monkey.eve_esi.esi.api_client');
        $client->setHttpClient($this->httpMock);
    }

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