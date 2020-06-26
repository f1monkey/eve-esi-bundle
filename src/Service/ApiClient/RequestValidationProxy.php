<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Service\ApiClient;

use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RequestValidationProxy
 *
 * @package F1monkey\EveEsiBundle\Service\ApiClient
 *
 * @internal
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
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function post(RequestInterface $request, string $responseClass): object
    {
        $this->validateRequestData($request->getRequest());

        return $this->apiClient->post($request, $responseClass);
    }

    /**
     * @param RequestInterface $request
     * @param string           $responseClass
     *
     * @return object
     * @throws RequestValidationException
     * @throws ApiClientExceptionInterface
     */
    public function get(RequestInterface $request, string $responseClass): object
    {
        $this->validateRequestData($request->getRequest());

        return $this->apiClient->get($request, $responseClass);
    }

    /**
     * @param object|null $data
     *
     * @throws RequestValidationException
     */
    protected function validateRequestData(?object $data): void
    {
        if ($data !== null) {
            $violations = $this->validator->validate($data);
            if ($violations->count()) {
                throw new RequestValidationException($violations, 'Request validation error');
            }
        }
    }
}