<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Factory\Esi;

use Codeception\Test\Unit;
use Exception;
use F1Monkey\EveEsiBundle\Factory\Esi\VerifyAccessTokenRequestFactory;
use F1Monkey\EveEsiBundle\ValueObject\EsiRequest;
use JMS\Serializer\ArrayTransformerInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class VerifyAccessTokenRequestFactoryTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Factory\Esi
 */
class VerifyAccessTokenRequestFactoryTest extends Unit
{
    /**
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanCreateVerifyAccessTokenRequest()
    {
        $token = 'token';

        /** @var ArrayTransformerInterface $transformer */
        $transformer = $this->makeEmpty(ArrayTransformerInterface::class);

        $prototype = new EsiRequest($transformer, 'url');
        $factory   = new VerifyAccessTokenRequestFactory();
        $factory->setRequestPrototype($prototype);

        $result = $factory->createVerifyAccessTokenRequest($token);

        $this->assertEqualsCanonicalizing(
            ['headers' => ['Authorization' => sprintf('Bearer %s', $token)]],
            $result->getGetRequestOptions()
        );
        $this->assertNull($result->getRequest());
    }
}