<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\Service\Esi;

use F1monkey\EveEsiBundle\Dto\OAuth\Response\Market\V1CharactersOrdersHistoryResponse;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Service\Esi\MarketServiceInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class MarketServiceTest
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\Service\Esi
 */
class MarketServiceTest extends AbstractEsiTestCase
{
    /**
     * @throws ApiClientExceptionInterface
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     */
    public function testCanGetV1CharactersOrdersHistory()
    {
        $response    = <<<JSON
[
  {
    "duration": 30,
    "escrow": 45.6,
    "is_buy_order": true,
    "is_corporation": false,
    "issued": "2016-09-03T05:12:25Z",
    "location_id": 456,
    "min_volume": 1,
    "order_id": 123,
    "price": 33.3,
    "range": "station",
    "region_id": 123,
    "state": "expired",
    "type_id": 456,
    "volume_remain": 4422,
    "volume_total": 123456
  }
]

JSON;
        $characterId = 10;
        $page        = 100;

        $this->httpMock->setResponse($response);

        /** @var MarketServiceInterface $service */
        $service = $this->tester->grabService('test.f1monkey.eve_esi.market_service');
        $result  = $service->getV1CharactersOrdersHistory('code', $characterId, $page);

        static::assertSame(
            'https://esi.evetech.net/v1/characters/10/orders/history/',
            $this->httpMock->getLastRequestUrl()
        );
        static::assertSame(['page' => $page], $this->httpMock->getLastRequestOptions()['query']);

        /** @var V1CharactersOrdersHistoryResponse $order */
        $order = $result->first();
        static::assertSame(30, $order->getDuration());
        static::assertSame(45.6, $order->getEscrow());
        static::assertSame(true, $order->isBuyOrder());
        static::assertSame(false, $order->isCorporation());
        static::assertEquals('2016-09-03 05:12:25', $order->getIssued()->format('Y-m-d H:i:s'));
        static::assertSame(456, $order->getLocationId());
        static::assertSame(1, $order->getMinVolume());
        static::assertSame(123, $order->getOrderId());
        static::assertSame(33.3, $order->getPrice());
        static::assertSame('station', $order->getRange());
        static::assertSame(123, $order->getRegionId());
        static::assertSame('expired', $order->getState());
        static::assertSame(456, $order->getTypeId());
        static::assertSame(4422, $order->getVolumeRemain());
        static::assertSame(123456, $order->getVolumeTotal());
    }
}