<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class TokenResponse
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Response
 */
class TokenResponse
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("access_token")
     */
    protected string $accessToken = '';

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("refresh_token")
     */
    protected string $refreshToken = '';

    /**
     * @var int
     *
     * @Serializer\Type("int")
     * @Serializer\SerializedName("expires_in")
     */
    protected int $expiresIn = 0;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("token_type")
     */
    protected string $tokenType = '';

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     */
    public function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     */
    public function setExpiresIn(int $expiresIn): void
    {
        $this->expiresIn = $expiresIn;
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
     */
    public function setTokenType(string $tokenType): void
    {
        $this->tokenType = $tokenType;
    }
}