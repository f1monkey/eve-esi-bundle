<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Factory\Esi;

use Codeception\Test\Unit;
use F1monkey\EveEsiBundle\Dto\Esi\Request\GenericPaginatedRequest;
use F1monkey\EveEsiBundle\Factory\Esi\MarketRequestFactory;
use F1monkey\EveEsiBundle\ValueObject\EsiRequest;
use JMS\Serializer\ArrayTransformerInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class MarketRequestFactoryTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Factory\Esi
 */
class MarketRequestFactoryTest extends Unit
{
    /**
     * @dataProvider pageProvider
     *
     * @param int|null $page
     *
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public function testCanCreateV1CharacterOrderHistoryRequest(?int $page)
    {
        $token = 'token';

        /** @var ArrayTransformerInterface $transformer */
        $transformer = $this->makeEmpty(ArrayTransformerInterface::class);

        $prototype = new EsiRequest($transformer, 'url');
        $factory   = new MarketRequestFactory();
        $factory->setRequestPrototype($prototype);

        $characterId = 123;
        $result      = $factory->createV1CharacterOrderHistoryRequest($token, $characterId, $page);

        static::assertArrayHasKey('Authorization', $result->getGetRequestOptions()['headers']);
        static::assertInstanceOf(GenericPaginatedRequest::class, $result->getRequest());
        static::assertEquals($page, $result->getRequest()->getPage());
    }

    /**
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public function testCanCreateV2CharactersOrdersRequest()
    {
        $token = 'token';

        /** @var ArrayTransformerInterface $transformer */
        $transformer = $this->makeEmpty(ArrayTransformerInterface::class);

        $prototype = new EsiRequest($transformer, 'url');
        $factory   = new MarketRequestFactory();
        $factory->setRequestPrototype($prototype);

        $characterId = 123;
        $result      = $factory->createV2CharactersOrdersRequest($token, $characterId);

        static::assertArrayHasKey('Authorization', $result->getGetRequestOptions()['headers']);
        static::assertNull($result->getRequest());
    }

    /**
     * @return array
     */
    public function pageProvider(): array
    {
        return [
            [null],
            [0],
            [2],
        ];
    }
}