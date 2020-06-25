<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Service\ApiClient;

use Codeception\Test\Unit;
use Exception;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1Monkey\EveEsiBundle\Service\ApiClient\RequestValidationProxy;
use F1Monkey\EveEsiBundle\ValueObject\RequestInterface;
use PHPUnit\Framework\ExpectationFailedException;
use stdClass;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RequestValidationProxyTest
 *
 * @package F1Monkey\EveEsiBundle\Tests\unit\Service\ApiClient
 */
class RequestValidationProxyTest extends Unit
{
    /**
     * @throws RequestValidationException
     * @throws ExpectationFailedException
     * @throws Exception
     */
    public function testCanValidatePostRequest()
    {
        $response   = new stdClass();
        $violations = $this->makeEmpty(ConstraintViolationListInterface::class, ['count' => 0]);
        /** @var ValidatorInterface $validator */
        $validator = $this->makeEmpty(ValidatorInterface::class, ['validate' => $violations]);
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class, ['post' => $response]);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(
            RequestInterface::class,
            [
                'getRequest' => new stdClass(),
            ]
        );

        $proxy  = new RequestValidationProxy($validator, $apiClient);
        $result = $proxy->post($request, stdClass::class);

        static::assertSame($response, $result);
    }

    /**
     * @throws RequestValidationException
     * @throws Exception
     */
    public function testCanThrowExceptionOnInvalidPostRequest()
    {
        $violations = $this->makeEmpty(
            ConstraintViolationListInterface::class,
            [
                'count' => 1,
            ]
        );
        /** @var ValidatorInterface $validator */
        $validator = $this->makeEmpty(
            ValidatorInterface::class,
            [
                'validate' => $violations,
            ]
        );
        /** @var ApiClientInterface $apiClient */
        $apiClient = $this->makeEmpty(ApiClientInterface::class);

        /** @var RequestInterface $request */
        $request = $this->makeEmpty(RequestInterface::class, ['getRequest' => new stdClass()]);
        $proxy   = new RequestValidationProxy($validator, $apiClient);

        $this->expectException(RequestValidationException::class);
        $proxy->post($request, stdClass::class);
    }
}