<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Factory\OAuth;

use Codeception\Test\Unit;
use Doctrine\Common\Collections\ArrayCollection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use F1Monkey\EveEsiBundle\Factory\OAuth\RedirectUrlFactory;
use PHPUnit\Framework\ExpectationFailedException;
use Sabre\Uri\InvalidUriException;

/**
 * Class RedirectUrlFactoryTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Factory\OAuth
 */
class RedirectUrlFactoryTest extends Unit
{
    /**
     * @dataProvider dataProvider
     *
     * @param array  $data
     * @param string $expected
     *
     * @throws ExpectationFailedException
     * @throws InvalidScopeCodeException
     * @throws InvalidUriException
     * @throws EmptyScopeCollectionException
     */
    public function testCanCreateRedirectUrl(
        array $data,
        string $expected
    )
    {
        $factory = new RedirectUrlFactory($data['oauth_url'], $data['redirect_url'], $data['client_id']);

        $result = $factory->createRedirectUrl($data['scopes']);

        $this->assertSame($expected, $result);
    }

    /**
     * @throws ExpectationFailedException
     * @throws InvalidUriException
     * @throws EmptyScopeCollectionException
     */
    public function testCannotCreateRedirectUrlWithInvalidScopes()
    {
        $factory = new RedirectUrlFactory('oauthUrl', 'redirectUrl', 'clientId');

        $scope1 = new Scope('invalid-code-1');
        $scope2 = new Scope('invalid-code-2');

        try {
            $factory->createRedirectUrl(new ArrayCollection([$scope1, $scope2]));
        } catch (InvalidScopeCodeException $e) {
            $this->assertEqualsCanonicalizing([$scope1, $scope2], $e->getInvalidScopes()->toArray());
        }
    }

    /**
     *
     */
    public function testCannotCreateRedirectUrlWithNoScopes()
    {
        $factory = new RedirectUrlFactory('oauthUrl', 'redirectuUrl', 'clientId');

        $this->expectException(EmptyScopeCollectionException::class);
        $factory->createRedirectUrl(new ArrayCollection());
    }

    /**
     * @return array<int, mixed>
     */
    public function dataProvider(): array
    {
        return [
            [
                [
                    'oauth_url'    => 'https://oauth.example.com',
                    'client_id'    => 'qwerty',
                    'redirect_url' => 'http://localhost:8080',
                    'scopes'       => new ArrayCollection([new Scope('publicData')]),
                ],
                'https://oauth.example.com/oauth/authorize?response_type=code&redirect_uri=http%3A%2F%2Flocalhost%3A8080&client_id=qwerty&scope=publicData&state=',
            ],
            [
                [
                    'oauth_url'    => 'https://oauth.example.com',
                    'client_id'    => 'qwerty',
                    'redirect_url' => 'http://localhost:8080',
                    'scopes'       => new ArrayCollection([new Scope('publicData'), new Scope('esi-calendar.respond_calendar_events.v1')]),
                ],
                'https://oauth.example.com/oauth/authorize?response_type=code&redirect_uri=http%3A%2F%2Flocalhost%3A8080&client_id=qwerty&scope=publicData+esi-calendar.respond_calendar_events.v1&state=',
            ],
        ];
    }
}