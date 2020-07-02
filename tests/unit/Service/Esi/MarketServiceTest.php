<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Service\Esi;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Dto\Esi\Response\EsiResponseCollection;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Factory\Esi\MarketRequestFactoryInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1monkey\EveEsiBundle\Service\Esi\MarketService;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class MarketServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Service\Esi
 */
class MarketServiceTest extends Unit
{
    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanGetV1CharactersOrdersHistory()
    {
        $expected = $this->makeEmpty(EsiResponseCollection::class);

        /** @var ApiClientInterface $client */
        $client = $this->makeEmpty(
            ApiClientInterface::class,
            [
                'get' => $expected,
            ]
        );
        /** @var MarketRequestFactoryInterface $factory */
        $factory = $this->makeEmpty(
            MarketRequestFactoryInterface::class,
            [
                'createV1CharacterOrderHistoryRequest' => $this->makeEmpty(RequestInterface::class),
            ]
        );

        $service = new MarketService($client, $factory);
        $result  = $service->getV1CharactersOrdersHistory('123', 123);

        static::assertSame($expected, $result);
    }

    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanGetV2CharactersOrders()
    {
        $expected = $this->makeEmpty(EsiResponseCollection::class);

        /** @var ApiClientInterface $client */
        $client = $this->makeEmpty(
            ApiClientInterface::class,
            [
                'get' => $expected,
            ]
        );
        /** @var MarketRequestFactoryInterface $factory */
        $factory = $this->makeEmpty(
            MarketRequestFactoryInterface::class,
            [
                'createV2CharactersOrdersRequest' => $this->makeEmpty(RequestInterface::class),
            ]
        );

        $service = new MarketService($client, $factory);
        $result  = $service->getV1CharactersOrdersHistory('123', 123);

        static::assertSame($expected, $result);
    }
}