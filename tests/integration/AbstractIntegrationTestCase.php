<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration;

use Codeception\Test\Unit;
use IntegrationTester;

/**
 * Class AbstractIntegrationTestCase
 *
 * @package F1monkey\EveEsiBundle\Tests\integration
 */
abstract class AbstractIntegrationTestCase extends Unit
{
    /**
     * @var IntegrationTester
     */
    protected IntegrationTester $tester;
}