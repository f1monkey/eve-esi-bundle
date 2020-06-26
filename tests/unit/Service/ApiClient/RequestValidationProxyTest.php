<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Tests\unit\Service\ApiClient;

use Codeception\Test\Unit;
use Exception;
use F1monkey\EveEsiBundle\Exception\ApiClient\ApiClientExceptionInterface;
use F1monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1monkey\EveEsiBundle\Service\ApiClient\RequestValidationProxy;
use F1monkey\EveEsiBundle\ValueObject\RequestInterface;
use PHPUnit\Framework\ExpectationFailedException;
use stdClass;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RequestValidationProxyTest
 *
 * @package F1monkey\EveEsiBundle\Tests\unit\Service\ApiClient
 */
class RequestValidationProxyTest extends Unit
{
    /**
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     * @throws ApiClientExceptionInterface
     */
    public function testCanValidateGetRequest()
    {
        $response = new stdClass();
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, ['get' => $response]);
        $proxy     = new RequestValidationProxy($this->createValidator(0), $apiClient);

        $result = $proxy->get($this->createRequest(), stdClass::class);

        static::assertSame($response, $result);
    }

    /**
     * @throws RequestValidationException
     * @throws Exception
     * @throws ApiClientExceptionInterface
     */
    public function testCanThrowExceptionOnInvalidGetRequest()
    {
        $response = new stdClass();
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, ['get' => $response]);
        $proxy     = new RequestValidationProxy($this->createValidator(1), $apiClient);

        $this->expectException(RequestValidationException::class);
        $proxy->get($this->createRequest(), stdClass::class);
    }

    /**
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     * @throws ApiClientExceptionInterface
     */
    public function testCanValidatePostRequest()
    {
        $response = new stdClass();
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, ['post' => $response]);
        $proxy     = new RequestValidationProxy($this->createValidator(0), $apiClient);

        $result = $proxy->post($this->createRequest(), stdClass::class);

        static::assertSame($response, $result);
    }

    /**
     * @throws RequestValidationException
     * @throws Exception
     * @throws ApiClientExceptionInterface
     */
    public function testCanThrowExceptionOnInvalidPostRequest()
    {
        $response = new stdClass();
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, ['post' => $response]);
        $proxy     = new RequestValidationProxy($this->createValidator(1), $apiClient);

        $this->expectException(RequestValidationException::class);
        $proxy->post($this->createRequest(), stdClass::class);
    }

    /**
     * @return RequestInterface
     * @throws Exception
     */
    protected function createRequest(): RequestInterface
    {
        /** @var RequestInterface $request */
        $request = $this->makeEmpty(
            RequestInterface::class,
            [
                'getRequest' => new stdClass(),
            ]
        );

        return $request;
    }

    /**
     * @param int $errorCount
     *
     * @return ValidatorInterface
     * @throws Exception
     */
    protected function createValidator(int $errorCount): ValidatorInterface
    {
        $violations = $this->makeEmpty(ConstraintViolationListInterface::class, ['count' => $errorCount]);
        /** @var ValidatorInterface $validator */
        $validator = $this->makeEmpty(ValidatorInterface::class, ['validate' => $violations]);

        return $validator;
    }
}