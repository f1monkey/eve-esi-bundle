<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Request;

use F1monkey\EveEsiBundle\Enum\OAuthEnum;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RefreshTokenRequest
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Request
 *
 * @internal
 */
class RefreshTokenRequest
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("grant_type")
     *
     * @Assert\NotBlank()
     */
    protected string $grantType = OAuthEnum::GRANT_TYPE_REFRESH_TOKEN;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("refresh_token")
     *
     * @Assert\NotBlank()
     */
    protected string $refreshToken;

    /**
     * RefreshTokenRequest constructor.
     *
     * @param string $refreshToken
     */
    public function __construct(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return string
     */
    public function getGrantType(): string
    {
        return $this->grantType;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
}