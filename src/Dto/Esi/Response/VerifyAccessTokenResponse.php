<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Dto\Esi\Response;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use F1Monkey\EveEsiBundle\Dto\Scope;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class VerifyAccessTokenResponse
 *
 * @package F1Monkey\EveEsiBundle\Dto\Esi\Response
 */
class VerifyAccessTokenResponse
{
    /**
     * @var int
     *
     * @Serializer\SerializedName("CharacterID")
     * @Serializer\Type("int")
     */
    protected int $characterId;

    /**
     * @var string
     *
     * @Serializer\SerializedName("CharacterName")
     * @Serializer\Type("string")
     */
    protected string $characterName;

    /**
     * @var DateTimeImmutable
     *
     * @Serializer\SerializedName("ExpiresOn")
     * @Serializer\Type("DateTimeImmutable<'Y-m-d\TH:i:s', 'UTC'>")
     */
    protected DateTimeImmutable $expiresOn;

    /**
     * @var Collection<int, Scope>
     *
     * @Serializer\SerializedName("Scopes")
     * @Serializer\Type("eve_esi_scopes")
     */
    protected Collection $scopes;

    /**
     * @var string
     *
     * @Serializer\SerializedName("TokenType")
     * @Serializer\Type("string")
     */
    protected string $tokenType;

    /**
     * @var string
     *
     * @Serializer\SerializedName("CharacterOwnerHash")
     * @Serializer\Type("string")
     */
    protected string $ownerHash;

    /**
     * @return int
     */
    public function getCharacterId(): int
    {
        return $this->characterId;
    }

    /**
     * @param int $characterId
     *
     * @return VerifyAccessTokenResponse
     */
    public function setCharacterId(int $characterId): VerifyAccessTokenResponse
    {
        $this->characterId = $characterId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharacterName(): string
    {
        return $this->characterName;
    }

    /**
     * @param string $characterName
     *
     * @return VerifyAccessTokenResponse
     */
    public function setCharacterName(string $characterName): VerifyAccessTokenResponse
    {
        $this->characterName = $characterName;

        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpiresOn(): DateTimeImmutable
    {
        return $this->expiresOn;
    }

    /**
     * @param DateTimeImmutable $expiresOn
     *
     * @return VerifyAccessTokenResponse
     */
    public function setExpiresOn(DateTimeImmutable $expiresOn): VerifyAccessTokenResponse
    {
        $this->expiresOn = $expiresOn;

        return $this;
    }

    /**
     * @return Collection<int, Scope>
     */
    public function getScopes(): Collection
    {
        return $this->scopes;
    }

    /**
     * @param Collection<int, Scope> $scopes
     *
     * @return VerifyAccessTokenResponse
     */
    public function setScopes(Collection $scopes): VerifyAccessTokenResponse
    {
        $this->scopes = $scopes;

        return $this;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @param string $tokenType
     *
     * @return VerifyAccessTokenResponse
     */
    public function setTokenType(string $tokenType): VerifyAccessTokenResponse
    {
        $this->tokenType = $tokenType;

        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerHash(): string
    {
        return $this->ownerHash;
    }

    /**
     * @param string $ownerHash
     *
     * @return VerifyAccessTokenResponse
     */
    public function setOwnerHash(string $ownerHash): VerifyAccessTokenResponse
    {
        $this->ownerHash = $ownerHash;

        return $this;
    }
}