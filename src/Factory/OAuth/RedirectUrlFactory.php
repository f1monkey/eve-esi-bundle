<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Factory\OAuth;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use F1Monkey\EveEsiBundle\Enum\OAuthEnum;
use F1Monkey\EveEsiBundle\Exception\OAuth\InvalidScopeCodeException;
use F1Monkey\EveEsiBundle\Exception\OAuth\EmptyScopeCollectionException;
use Sabre\Uri\InvalidUriException;
use function array_merge;
use function implode;
use function Sabre\Uri\build as buildUrl;
use function Sabre\Uri\parse as parseUrl;
use function sprintf;

/**
 * Class RedirectUrlFactory
 *
 * @package F1Monkey\EveEsiBundle\Factory\OAuth
 */
class RedirectUrlFactory implements RedirectUrlFactoryInterface
{
    /**
     * @var string
     */
    protected string $oauthUrl;

    /**
     * @var string
     */
    protected string $redirectUrl;

    /**
     * @var string
     */
    protected string $clientId;

    /**
     * RedirectUrlFactory constructor.
     *
     * @param string $oauthUrl
     * @param string $redirectUrl
     * @param string $clientId
     */
    public function __construct(string $oauthUrl, string $redirectUrl, string $clientId)
    {
        $this->oauthUrl    = $oauthUrl;
        $this->redirectUrl = $redirectUrl;
        $this->clientId    = $clientId;
    }

    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return string
     * @throws InvalidScopeCodeException
     * @throws InvalidUriException
     * @throws EmptyScopeCollectionException
     */
    public function createRedirectUrl(Collection $scopes): string
    {
        if ($scopes->isEmpty()) {
            throw new EmptyScopeCollectionException('At least one scope is required');
        }

        $invalidScopes = $this->getInvalidScopes($scopes);
        if (!$invalidScopes->isEmpty()) {
            throw new InvalidScopeCodeException(
                $invalidScopes,
                sprintf('Invalid scope codes: %s', implode(', ', $this->getScopeCodes($invalidScopes)))
            );
        }

        $scopeCodes = $this->getScopeCodes($scopes);

        return buildUrl(
            array_merge(
                parseUrl($this->oauthUrl),
                [
                    'path'  => OAuthEnum::ENDPOINT_AUTHORIZE,
                    'query' => http_build_query($this->createQuery($scopeCodes)),
                ]
            )
        );
    }

    /**
     * @param string[] $scopes
     *
     * @return string[]
     */
    protected function createQuery(array $scopes): array
    {
        return [
            'response_type' => OAuthEnum::RESPONSE_TYPE_CODE,
            'redirect_uri'  => $this->redirectUrl,
            'client_id'     => $this->clientId,
            'scope'         => implode(' ', array_unique($scopes)),
            /* @todo https://developers.eveonline.com/blog/article/sso-to-authenticated-calls */
            'state'         => '',
        ];
    }

    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return array
     */
    protected function getScopeCodes(Collection $scopes): array
    {
        return array_filter(
            array_map(
                static function (Scope $scope) {
                    return (string)$scope;
                },
                $scopes->toArray()
            )
        );
    }

    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return Collection<int, Scope>
     */
    protected function getInvalidScopes(Collection $scopes): Collection
    {
        $result  = new ArrayCollection();
        $codeMap = array_flip(OAuthEnum::SCOPES);
        foreach ($scopes as $scope) {
            if (!isset($codeMap[(string)$scope])) {
                $result->add($scope);
            }
        }

        return $result;
    }
}