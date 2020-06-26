<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Dto\OAuth\Response;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ErrorResponse
 *
 * @package F1monkey\EveEsiBundle\Dto\OAuth\Response
 */
class ErrorResponse
{
    /**
     * @var string|null
     *
     * @Serializer\SerializedName("error")
     * @Serializer\Type("string")
     */
    protected ?string $error;

    /**
     * @var string|null
     *
     * @Serializer\SerializedName("error_description")
     * @Serializer\Type("string")
     */
    protected ?string $errorDescription;

    /**
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string|null $error
     *
     * @return ErrorResponse
     */
    public function setError(?string $error): ErrorResponse
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getErrorDescription(): ?string
    {
        return $this->errorDescription;
    }

    /**
     * @param string|null $errorDescription
     *
     * @return ErrorResponse
     */
    public function setErrorDescription(?string $errorDescription): ErrorResponse
    {
        $this->errorDescription = $errorDescription;

        return $this;
    }
}