<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Serializer;

use Codeception\Test\Unit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Exception;
use F1monkey\EveEsiBundle\Dto\Scope;
use F1monkey\EveEsiBundle\Serializer\Handler\ScopeHandler;
use JMS\Serializer\VisitorInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class ScopeHandlerTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Serializer
 */
class ScopeHandlerTest extends Unit
{
    /**
     * @dataProvider scopesProvider
     *
     * @param Collection $scopes
     * @param string     $expected
     *
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanSerializeScopesToJson(Collection $scopes, string $expected)
    {
        /** @var VisitorInterface $visitor */
        $visitor = $this->makeEmpty(VisitorInterface::class);
        $handler = new ScopeHandler();

        $result = $handler->serializeScopesToJson($visitor, $scopes);
        static::assertSame($expected, $result);
    }

    /**
     * @dataProvider scopesProvider
     *
     * @param Collection $expected
     * @param string     $scopes
     *
     * @throws ExpectationFailedException
     */
    public function testCanDeserializeScopesFromJson(Collection $expected, string $scopes)
    {
        /** @var VisitorInterface $visitor */
        $visitor = $this->makeEmpty(VisitorInterface::class);
        $handler = new ScopeHandler();

        $result = $handler->deserializeScopesFromJson($visitor, $scopes);
        static::assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @return array[]
     */
    public function scopesProvider(): array
    {
        return [
            [
                new ArrayCollection([new Scope('publicData')]),
                'publicData',
            ],
            [
                new ArrayCollection([new Scope('publicData'), new Scope('esi-skills.read_skills.v1')]),
                'publicData esi-skills.read_skills.v1',
            ],
        ];
    }
}