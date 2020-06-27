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
     *
     * @return TokenResponse
     */
    public function setAccessToken(string $accessToken): TokenResponse
    {
        $this->accessToken = $accessToken;

        return $this;
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
     *
     * @return TokenResponse
     */
    public function setRefreshToken(string $refreshToken): TokenResponse
    {
        $this->refreshToken = $refreshToken;

        return $this;
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
     *
     * @return TokenResponse
     */
    public function setExpiresIn(int $expiresIn): TokenResponse
    {
        $this->expiresIn = $expiresIn;

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
     * @return TokenResponse
     */
    public function setTokenType(string $tokenType): TokenResponse
    {
        $this->tokenType = $tokenType;

        return $this;
    }
}