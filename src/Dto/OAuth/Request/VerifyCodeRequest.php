<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Request;

use F1monkey\EveEsiBundle\Enum\OAuthEnum;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VerifyCodeRequest
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Request
 *
 * @internal
 */
class VerifyCodeRequest
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("grant_type")
     *
     * @Assert\NotBlank()
     */
    protected string $grantType = OAuthEnum::GRANT_TYPE_CODE;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Serializer\SerializedName("code")
     *
     * @Assert\NotBlank()
     */
    protected string $authorizationCode;

    /**
     * VerifyTokenRequest constructor.
     *
     * @param string $authorizationCode
     */
    public function __construct(string $authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
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
    public function getAuthorizationCode(): string
    {
        return $this->authorizationCode;
    }
}