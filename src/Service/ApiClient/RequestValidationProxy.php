<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use RuntimeException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RequestValidationProxy
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 */
class RequestValidationProxy implements ApiClientInterface
{
    /**
     * @var ValidatorInterface
     */
    protected ValidatorInterface $validator;

    /**
     * @var ApiClientInterface
     */
    protected ApiClientInterface $apiClient;

    /**
     * RequestValidationProxy constructor.
     *
     * @param ValidatorInterface $validator
     * @param ApiClientInterface $apiClient
     */
    public function __construct(ValidatorInterface $validator, ApiClientInterface $apiClient)
    {
        $this->validator = $validator;
        $this->apiClient = $apiClient;
    }

    /**
     * @param string $endpoint
     * @param object $body
     *
     * @return string
     * @throws RequestValidationException
     * @throws RuntimeException
     */
    public function post(string $endpoint, object $body): string
    {
        $violations = $this->validator->validate($body);
        if ($violations->count()) {
            throw new RequestValidationException($violations, 'Request validation error');
        }

        return $this->apiClient->post($endpoint, $body);
    }
}