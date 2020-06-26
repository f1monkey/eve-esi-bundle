<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\integration\Serializer;

use Doctrine\Common\Collections\ArrayCollection;
use F1monkey\EveEsiBundle\Dto\Scope;
use F1monkey\EveEsiBundle\Tests\integration\AbstractIntegrationTestCase;
use F1monkey\EveEsiBundle\Tests\integration\mocks\ScopeListDto;
use JMS\Serializer\ArrayTransformerInterface;
use PHPUnit\Framework\ExpectationFailedException;

/**
 * Class ScopeHandlerTest
 *
 * @package F1monkey\EveEsiBundle\Tests\integration\Serializer
 */
class ScopeHandlerTest extends AbstractIntegrationTestCase
{
    /**
     * @dataProvider scopesProvider
     *
     * @param ScopeListDto $scopes
     * @param array        $expected
     *
     * @throws ExpectationFailedException
     */
    public function testCanSerializeScopes(ScopeListDto $scopes, array $expected)
    {
        /** @var ArrayTransformerInterface $serializer */
        $serializer = $this->tester->grabService('jms_serializer');

        $result = $serializer->toArray($scopes);

        static::assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @dataProvider scopesProvider
     *
     * @param ScopeListDto $expected
     * @param array        $scopes
     *
     * @throws ExpectationFailedException
     */
    public function testCanDeserializeScopesFromJson(ScopeListDto $expected, array $scopes)
    {
        /** @var ArrayTransformerInterface $serializer */
        $serializer = $this->tester->grabService('jms_serializer');

        $result = $serializer->fromArray($scopes, ScopeListDto::class);

        static::assertEqualsCanonicalizing($expected, $result);
    }

    /**
     * @return array[]
     */
    public function scopesProvider(): array
    {
        return [
            [
                new ScopeListDto(
                    new ArrayCollection(
                        [
                            new Scope('publicData'),
                        ]
                    )
                ),
                ['scopes' => 'publicData'],
            ],
            [
                new ScopeListDto(
                    new ArrayCollection(
                        [
                            new Scope('publicData'),
                            new Scope('esi-skills.read_skills.v1'),
                        ]
                    )
                ),
                ['scopes' => 'publicData esi-skills.read_skills.v1'],
            ],
        ];
    }
}