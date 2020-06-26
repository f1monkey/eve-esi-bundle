<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Factory\OAuth;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Dto\OAuth\Request\RefreshTokenRequest;
use F1monkey\EveEsiBundle\Dto\OAuth\Request\VerifyCodeRequest;
use F1monkey\EveEsiBundle\Factory\OAuth\OAuthRequestFactory;
use F1monkey\EveEsiBundle\ValueObject\OAuthRequest;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use JMS\Serializer\ArrayTransformerInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class OAuthRequestFactoryTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Factory\OAuth
 */
class OAuthRequestFactoryTest extends Unit
{
    /**
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanCreateVerifyCodeRequest()
    {
        $code    = 'code';

        $factory = new OAuthRequestFactory($this->createRequestPrototype());
        $result  = $factory->createVerifyCodeRequest($code);

        static::assertInstanceOf(VerifyCodeRequest::class, $result->getRequest());
        static::assertSame($code, $result->getRequest()->getAuthorizationCode());
    }

    /**
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanCreateRefreshTokenRequest()
    {
        $token = 'token';

        $factory = new OAuthRequestFactory($this->createRequestPrototype());
        $result  = $factory->createRefreshTokenRequest($token);

        static::assertInstanceOf(RefreshTokenRequest::class, $result->getRequest());
        static::assertSame($token, $result->getRequest()->getRefreshToken());
    }

    /**
     * @return RequestInterface
     * @throws Exception
     */
    protected function createRequestPrototype(): RequestInterface
    {
        /** @var ArrayTransformerInterface $transformer */
        $transformer      = $this->makeEmpty(ArrayTransformerInterface::class);
        return new OAuthRequest($transformer, 'baseUrl', 'clientId', 'secret');
    }
}