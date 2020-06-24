<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Tests\unit\Service\ApiClient;

use Codeception\Test\Unit;
use F1Monkey\EveEsiBundle\Exception\ApiClient\RequestValidationException;
use F1Monkey\EveEsiBundle\Service\ApiClient\ApiClientInterface;
use F1Monkey\EveEsiBundle\Service\ApiClient\RequestValidationProxy;
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
     * @throws \RuntimeException
     */
    public function testCanValidatePostRequest()
    {
        $response   = 'response';
        $violations = $this->makeEmpty(
            ConstraintViolationListInterface::class,
            [
                'count' => 0,
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
        $apiClient = $this->makeEmpty(
            ApiClientInterface::class,
            [
                'post' => $response,
            ]
        );

        $proxy  = new RequestValidationProxy($validator, $apiClient);
        $result = $proxy->post('/hello', new stdClass());

        static::assertSame($response, $result);
    }

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

        $proxy = new RequestValidationProxy($validator, $apiClient);

        $this->expectException(RequestValidationException::class);
        $proxy->post('/hello', new stdClass());
    }
}