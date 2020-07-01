<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\Service\Esi;

use F1monkey\EveEsiBundle\Service\ApiClient\ApiClient;
use F1monkey\EveEsiBundle\Tests\integration\AbstractIntegrationTestCase;
use F1monkey\EveEsiBundle\Tests\integration\mocks\HttpClientMock;

/**
 * Class AbstractEsiTestCase
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\Service\Esi
 */
abstract class AbstractEsiTestCase extends AbstractIntegrationTestCase
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
}