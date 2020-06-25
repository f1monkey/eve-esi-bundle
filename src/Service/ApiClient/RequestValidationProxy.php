<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RequestValidationProxy
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
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
     */
    public function post(RequestInterface $request, string $responseClass): object
    {
        $violations = $this->validator->validate($request->getRequest());
        if ($violations->count()) {
            throw new RequestValidationException($violations, 'Request validation error');
        }

        return $this->apiClient->post($request, $responseClass);
    }
}