<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\Event;

use Psr\Http\Message\ResponseInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class RequestAfterEvent
 *
 * @package F1monkey\EveEsiBundle\Event
 */
class RequestAfterEvent extends Event
{
    /**
     * @var object
     */
    protected object $responseObject;

    /**
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * RequestAfterEvent constructor.
     *
     * @param object            $responseObject
     * @param ResponseInterface $response
     */
    public function __construct(object $responseObject, ResponseInterface $response)
    {
        $this->responseObject = $responseObject;
        $this->response       = $response;
    }

    /**
     * @return object
     */
    public function getResponseObject(): object
    {
        return $this->responseObject;
    }

    /**
     * @param object $responseObject
     *
     * @return RequestAfterEvent
     */
    public function setResponseObject(object $responseObject): RequestAfterEvent
    {
        $this->responseObject = $responseObject;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}