<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Serializer\Handler;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use F1monkey\EveEsiBundle\Dto\Scope;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

/**
 * Class ScopeHandler
 *
 * @package App\EveApi\Serializer
 */
class ScopeHandler implements SubscribingHandlerInterface
{
    /**
     * @return array<int, array<string, int|string>>
     */
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format'    => 'json',
                'type'      => 'eve_esi_scopes',
                'method'    => 'serializeScopesToJson',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format'    => 'json',
                'type'      => 'eve_esi_scopes',
                'method'    => 'deserializeScopesFromJson',
            ],
        ];
    }/** @noinspection PhpUnusedParameterInspection */

    /**
     * @param VisitorInterface $visitor
     * @param Collection<int, Scope>  $scopes
     *
     * @return string
     */
    public function serializeScopesToJson(VisitorInterface $visitor, Collection $scopes): string
    {
        $codes = $scopes->map(
            static function (Scope $scope) {
                return (string)$scope;
            }
        );

        return implode(' ', $codes->toArray());
    }/** @noinspection PhpUnusedParameterInspection */

    /**
     * @param VisitorInterface $visitor
     * @param string           $scopeCodes
     *
     * @return ArrayCollection<int, Scope>
     */
    public function deserializeScopesFromJson(VisitorInterface $visitor, string $scopeCodes): ArrayCollection
    {
        $codes = explode(' ', $scopeCodes);

        $scopes = array_map(
            static function (string $code) {
                return (new Scope($code));
            },
            $codes
        );

        return new ArrayCollection($scopes);
    }
}