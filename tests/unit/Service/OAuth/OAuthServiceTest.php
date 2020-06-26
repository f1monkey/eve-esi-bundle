<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Service\OAuth;

use Codeception\Test\Unit;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use F1monkey\EveEsiBundle\Dto\OAuth\Response\TokenResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1monkey\EveEsiBundle\Factory\OAuth\OAuthRequestFactoryInterface;
use F1monkey\EveEsiBundle\Factory\OAuth\RedirectUrlFactoryInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1monkey\EveEsiBundle\Service\OAuth\OAuthService;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class OAuthServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Service\OAuthService
 */
class OAuthServiceTest extends Unit
{
    /**
     * @throws EmptyScopeCollectionException
     * @throws InvalidScopeCodeException
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanCreateRedirectUrl()
    {
        $expected = 'qwerty';
        /** @var RedirectUrlFactoryInterface $factory */
        $factory = $this->makeEmpty(RedirectUrlFactoryInterface::class, ['createRedirectUrl' => $expected]);
        /** @var OAuthRequestFactoryInterface $requestFactory */
        $requestFactory = $this->makeEmpty(OAuthRequestFactoryInterface::class);
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class);

        $service = new OAuthService($factory, $requestFactory, $apiClient);
        $result  = $service->createRedirectUrl(new ArrayCollection());
        static::assertSame($expected, $result);
    }

    /**
     * @throws ExpectationFailedException
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws Exception
     */
    public function testCanVerifyAuthorizationCode()
    {
        $expected = new TokenResponse();
        $expected->setTokenType('Bearer');
        /** @var RedirectUrlFactoryInterface $factory */
        $factory = $this->makeEmpty(RedirectUrlFactoryInterface::class, ['createRedirectUrl' => $expected]);
        /** @var OAuthRequestFactoryInterface $requestFactory */
        $requestFactory = $this->makeEmpty(OAuthRequestFactoryInterface::class);
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, [
            'post' => $expected
        ]);

        $service = new OAuthService($factory, $requestFactory, $apiClient);
        $result  = $service->verifyCode('code');
        static::assertSame($expected, $result);
    }

    /**
     * @throws ExpectationFailedException
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws Exception
     */
    public function testCanRefreshAccessToken()
    {
        $expected = new TokenResponse();
        $expected->setTokenType('Bearer');
        /** @var RedirectUrlFactoryInterface $factory */
        $factory = $this->makeEmpty(RedirectUrlFactoryInterface::class, ['createRedirectUrl' => $expected]);
        /** @var OAuthRequestFactoryInterface $requestFactory */
        $requestFactory = $this->makeEmpty(OAuthRequestFactoryInterface::class);
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, [
            'post' => $expected
        ]);

        $service = new OAuthService($factory, $requestFactory, $apiClient);
        $result  = $service->refreshToken('refreshToken');
        static::assertSame($expected, $result);
    }
}