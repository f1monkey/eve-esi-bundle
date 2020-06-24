<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\Service\ApiClient;

use F1Monkey\EveEsiBundle\Exception\ApiClient\ImpossibleException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use RuntimeException;
use Sabre\Uri\InvalidUriException;
use Symfony\Component\HttpFoundation\Request;
use function Sabre\Uri\resolve as resolve;

/**
 * Class ApiClient
 *
 * @package F1Monkey\EveEsiBundle\Service\ApiClient
 */
class ApiClient implements ApiClientInterface
{
    /**
     * @var ClientInterface
     */
    protected ClientInterface $guzzle;

    /**
     * @var RequestOptionsProviderInterface
     */
    protected RequestOptionsProviderInterface $optionsProvider;

    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * ApiClient constructor.
     *
     * @param ClientInterface                 $guzzle
     * @param RequestOptionsProviderInterface $optionsProvider
     * @param string                          $baseUrl
     */
    public function __construct(
        ClientInterface $guzzle,
        RequestOptionsProviderInterface $optionsProvider,
        string $baseUrl
    )
    {
        $this->guzzle          = $guzzle;
        $this->optionsProvider = $optionsProvider;
        $this->baseUrl         = $baseUrl;
    }

    /**
     * @param string $endpoint
     * @param object $body
     *
     * @return string
     * @throws InvalidUriException
     * @throws RuntimeException
     */
    public function post(string $endpoint, object $body): string
    {
        $options = $this->optionsProvider->createPostRequestOptions($body);

        try {
            $response = $this->guzzle->request(
                Request::METHOD_POST,
                $this->createUrl($endpoint),
                $options
            );
        } catch (GuzzleException $e) {
            if ($e instanceof RequestException) {
                // @todo handle request exception
            }

            throw new ImpossibleException($e->getMessage(), $e->getCode(), $e);
        }

        return $response->getBody()->getContents();
    }

    /**
     * @param string $endPoint
     *
     * @return string
     * @throws InvalidUriException
     */
    protected function createUrl(string $endPoint): string
    {
        return resolve($this->baseUrl, $endPoint);
    }
}