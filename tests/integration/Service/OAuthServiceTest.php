<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\integration\Service;

use F1Monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Exception\OAuth\OAuthRequestException;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClient;
use F1Monkey\EveEsiBundle\Service\OAuth\OAuthServiceInterface;
use F1Monkey\EveEsiBundle\Tests\integration\AbstractIntegrationTestCase;
use F1Monkey\EveEsiBundle\Tests\integration\mocks\OAuthHttpClientMock;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class OAuthServiceTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\integration\Service
 */
class OAuthServiceTest extends AbstractIntegrationTestCase
{
    /**
     * @var OAuthHttpClientMock
     */
    protected OAuthHttpClientMock $httpMock;

    public function _before()
    {
        parent::_before();
        /** @var ApiClient $client */
        $this->httpMock = new OAuthHttpClientMock();
        $client         = $this->tester->grabService('f1monkey.eve_esi.oauth.api_client');
        $client->setHttpClient($this->httpMock);
    }

    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws OAuthRequestException
     * @throws ExpectationFailedException
     */
    public function testCanGetVerifyCode()
    {
        $response = <<<JSON
{
    "access_token": "1|CfDJ8Hj9X4L/huFJpslTkv3swZPa8ALV0AGtNR0MsyntFdoKrWlr6yv0EEwR9lyVHmeZfogeEklqllmjoBHGU+rwgtznTefI8cqZMyeSaCIXz3QXDMHWYoQnq4npTohlA2Z4Pux5d7++uSvhHNnQwlldO5oQhbILVc7V+lozPCbEPNKQ",
    "token_type": "Bearer",
    "expires_in": 1199,
    "refresh_token": "EoeMEIPNicHuAt6LjnjMQDq-14P1wGZ9J63ZbjgfVu33"
}
JSON;
        $this->httpMock->setResponse($response);

        /** @var OAuthServiceInterface $service */
        $service = $this->tester->grabService('test.f1monkey.eve_esi.oauth_service');
        $result  = $service->verifyCode('code');

        static::assertSame('Bearer', $result->getTokenType());
    }
}